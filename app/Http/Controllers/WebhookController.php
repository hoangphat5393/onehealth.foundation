<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Stripe\Event as StripeEvent;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

use Mail;
use App\Mail\SendMail;

class WebhookController extends Controller
{
    /**
     * Handle a Stripe webhook call.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleWebhook(Request $request)
    {
        $payload = json_decode($request->getContent(), true);

        if (!$this->isInTestingEnvironment() && !$this->eventExistsOnStripe($payload['id'])) {
            return;
        }

        $method = str_replace('.', '_', $payload['type']);

        if (method_exists($this, $method)) {
            return $this->{$method}($payload);
        } else {
            return $this->missingMethod();
        }
    }

    /**
     * Handle a cancelled customer from a Stripe subscription.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function handleCustomerSubscriptionDeleted(array $payload)
    {
        $user = $this->getUserByStripeId($payload['data']['object']['customer']);

        if ($user) {
            $user->subscriptions->filter(function ($subscription) use ($payload) {
                return $subscription->stripe_id === $payload['data']['object']['id'];
            })->each(function ($subscription) {
                $subscription->markAsCancelled();
            });
        }

        return new Response('Webhook Handled', 200);
    }

    /**
     * Get the billable entity instance by Stripe ID.
     *
     * @param  string  $stripeId
     * @return \Laravel\Cashier\Billable
     */
    protected function getUserByStripeId($stripeId)
    {
        $model = Cashier::stripeModel();

        return (new $model)->where('stripe_id', $stripeId)->first();
    }

    /**
     * Verify with Stripe that the event is genuine.
     *
     * @param  string  $id
     * @return bool
     */
    protected function eventExistsOnStripe($id)
    {
        try {
            return !is_null(StripeEvent::retrieve($id, config('services.stripe.secret')));
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Verify if cashier is in the testing environment.
     *
     * @return bool
     */
    protected function isInTestingEnvironment()
    {
        return getenv('CASHIER_ENV') === 'testing';
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param  array  $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function missingMethod($parameters = [])
    {
        return new Response;
    }

    protected function charge_succeeded(array $eventData)
    {
        Log::debug($eventData);
        $payment_intent = $eventData['data']['object']['payment_intent'];

        $payment = \App\Models\PaymentRequest::where('transaction_code', $payment_intent)->where('status', 0)->first();
        if ($payment && $eventData['type'] == 'charge.succeeded') {
            $transaction_status = '';
            $status = 0;
            $cart_payment = 0;
            switch ($eventData['type']) {
                case 'charge.expired':
                    $transaction_status = "expired";
                    $cart_payment = 5;
                    break;

                case 'charge.failed':
                    $transaction_status = "failed";
                    $cart_payment = 6;
                    break;

                case 'charge.pending':
                    $transaction_status = "pending";
                    $cart_payment = 3;
                    break;

                case 'charge.refunded':
                    $transaction_status = "refunded";
                    $cart_payment = 4;
                    break;
                case 'charge.succeeded':
                    $status = 1;
                    $transaction_status = "succeeded";
                    $cart_payment = 1;
                    break;
            }


            $payment->status = $status;
            $payment->transaction_status = $transaction_status;
            $payment->save();

            $cart = \App\Models\Addtocard::where('cart_id', $payment->cart_id)->first();
            $cart->cart_payment = $cart_payment;
            $cart->save();

            $shop_payment_method = \App\Models\ShopPaymentMethod::where('status', 1)->get()->pluck('name', 'code')->toArray();
            if ($cart) {
                $order_id = $cart->cart_code;
                $data_email = $cart->toArray();
                $data_email['email_admin'] = 'huunamtn@gmail.com'; // setting_option('email_admin');
                $data_email['subject_default'] = 'Payment success';

                $checkContent = \App\Models\ShopEmailTemplate::where('group', 'order_to_user')->where('status', 1)->first();
                $checkContent_admin = \App\Models\ShopEmailTemplate::where('group', 'order_to_admin')->where('status', 1)->first();
                if ($checkContent || $checkContent_admin) {

                    $content = htmlspecialchars_decode($checkContent->text);
                    $content_admin = htmlspecialchars_decode($checkContent_admin->text);

                    $order_detail = \App\Models\Addtocard_Detail::where('cart_id', $payment->cart_id)->get();
                    $orderDetail = '';
                    foreach ($order_detail as $key => $detail) {
                        $product = $detail->getProduct;
                        $nameProduct = $detail->name;
                        $product_attr = '';

                        if ($detail->option) {
                            $attribute = json_decode($detail->option, true);
                            foreach ($attribute as $groupAtt => $attrs) {
                                foreach ($attrs as $item) {
                                    $product_attr .= '<tr><td>' . $item['name'] . '</td><td><strong>' . $item['value'] . '</strong></td></tr>';
                                }
                            }
                        }
                        $orderDetail .= '<tr><td colspan="2"><b>' . ($key + 1) . '.' . $detail->name . '</b></td></tr>';
                        $orderDetail .= $product_attr;
                        $orderDetail .= '<tr><td width="150">Price:</td><td><strong>' . render_price($detail->subtotal / $detail->quanlity) . '</strong></td></tr>';
                        $orderDetail .= '<tr><td>Qty:</td><td><strong>' . number_format($detail->quanlity) . '</strong></td></tr>';
                        $orderDetail .= '<tr><td>Total:</td><td><strong>' . render_price($detail->subtotal) . '</strong></td></tr>';
                        $orderDetail .= '<tr><td colspan="2"><hr></td></tr>';
                    }

                    //Phương thức nhận hàng
                    $receive = $cart->shipping_type ?? 'pick_up';
                    $receive_html = 'Nhận sau khi thanh toán thành công';

                    //phuong thuc thanh toan
                    $payment_method = implode('__', [$payment->payment_gate, $payment->payment_method]);
                    $payment_method_html = '';
                    if ($payment_method == 'cash') {
                        $payment_method_html = '<div>- Thanh toán bằng tiền mặt khi nhận hàng</div>';
                    } elseif (!empty($shop_payment_method[$payment_method])) {
                        $payment_method_html = '<div class="mb-3">- ' . $shop_payment_method[$payment_method] . '</div>';
                    }

                    $shipping_cost = $cart->shipping_cost ?? 0;

                    $dataFind = [
                        '/\{\{\$orderID\}\}/',
                        '/\{\{\$toname\}\}/',
                        '/\{\{\$email\}\}/',
                        '/\{\{\$address\}\}/',
                        '/\{\{\$phone\}\}/',
                        '/\{\{\$comment\}\}/',
                        '/\{\{\$shipping_cost\}\}/',
                        '/\{\{\$subtotal\}\}/',
                        '/\{\{\$total\}\}/',
                        '/\{\{\$receive\}\}/',
                        '/\{\{\$orderDetail\}\}/',
                        '/\{\{\$payment_method\}\}/',
                    ];
                    $dataReplace = [
                        $order_id ?? '',
                        $data_email['name'] ?? '',
                        $data_email['cart_email'] ?? '',
                        $data_email['cart_address'] ?? '',
                        $data_email['cart_phone'] ?? '',
                        $data_email['cart_note'] ?? '',
                        render_price($shipping_cost),
                        render_price($cart->cart_total),
                        render_price($cart->cart_total + $shipping_cost),
                        $receive_html,
                        $orderDetail,
                        $payment_method_html,
                    ];
                    $content = preg_replace($dataFind, $dataReplace, $content);
                    $content_admin = preg_replace($dataFind, $dataReplace, $content_admin);
                    // dd($content);
                    $dataView = [
                        'content' => $content,
                    ];
                    $config = [
                        'to' => $data_email['cart_email'],
                        'subject' => 'Đơn hàng mới - Mã đơn hàng: ' . $order_id,
                    ];

                    $dataView_sys = [
                        'content' => $content_admin,
                    ];
                    $config_sys = [
                        'to' => $data_email['email_admin'],
                        'subject' => 'Đơn hàng mới - Mã đơn hàng: ' . $order_id,
                    ];

                    $send_mail = new SendMail('email.content', $dataView, $config);
                    Mail::send($send_mail);

                    $send_mail_admin = new SendMail('email.content', $dataView_sys, $config_sys);
                    Mail::send($send_mail_admin);
                }
            }
        }
    }
}
