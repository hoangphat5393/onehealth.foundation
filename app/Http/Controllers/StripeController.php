<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart, Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Str;

use App\Traits\Stripe;
use Stripe\Charge;
use Stripe\Exception\ApiErrorException;
use Stripe\Invoice;
use Stripe\PaymentIntent;
use Stripe\Plan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Stripe\Subscription;

use Mail;
use App\Mail\SendMail;

class StripeController extends Controller
{
    use Stripe;

    public function __construct()
    {
        parent::__construct();

        $this->getStripeClient();
    }

    public function checkout($data)
    {
        // dd($data);
        $cart_info = session()->get('cart-info');
        if (!$cart_info)
            return redirect(route('cart'));

        $user = request()->user();

        $option_session = session()->get('option');
        if ($option_session) {
            $option = json_decode($option_session[0], true);
            $total = $option['price'] * $option['qty'];

            $price = $total; // + $shipping_cost;
        } else {
            $price = Cart::total(2); // + $shipping_cost;
        }

        $price = $price * 100;



        $cart = \App\Models\Addtocard::where('cart_code', $data['cart_code'])->first();
        try {
            $dataCreate = [
                'payment_method_types'  => [$data['payment_method']],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Thanh toán đơn hàng - ' . $data['cart_code'],
                        ],
                        'unit_amount' => $price,
                    ],
                    'quantity' => 1,
                ]],
                'client_reference_id' => $user->id ?? time(),
                'mode' => 'payment',
                'success_url' => route('strip_payment_success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('strip_payment_cancel'),
            ];

            $promotionCode = $data['promotion_code'] ?? '';
            if ($promotionCode) {
                $dataCreate['discounts'] = [[
                    'coupon' => $promotionCode->coupon->id
                ]];
                Log::info("Promotion code {$promotionCode->code} have been applied for user " . $user->email ?? $cart_info['email'] . " !");
            }

            $session = \Stripe\Checkout\Session::create($dataCreate);

            $schedule_payment = \App\Models\PaymentRequest::create(
                [
                    'user_id' => $user->id ?? 0,
                    'cart_id' => $cart->cart_id,
                    'payment_gate' => 'stripe',
                    'payment_method' => $data['payment_method'],
                    'amount' => $session->amount_total / 100,
                    'session_id' => $session->id,
                    'transaction_url' => $session->url,
                    'transaction_status' => $session->payment_status ?? ($session['error'] ?? ''),
                    'transaction_code' => $session->payment_intent,
                    'status' => 0, // 0 chua thanh toan, 1 da thanh toan

                ]
            );

            if ($session && !$session['error']) {
                Cart::destroy();
                session()->forget('option');
                session()->forget('cart-info');
                // session()->forget('cart_code');

                return redirect($session['url']);
            }
        } catch (ApiErrorException $e) {
            Log::warning($e->getMessage());
            return response()->json($e->getMessage());
        }
    }

    public function paymentSuccess()
    {
        $data = request()->all();
        $cart_code = session()->get('cart_code');
        if (isset($data['session_id']) && $cart_code) {
            $payment = \App\Models\PaymentRequest::where('session_id', $data['session_id'])->first();
            if ($payment) {
                $content_success = \App\Models\Page::find(94);
                $cart = \App\Models\Addtocard::where('cart_code', $cart_code)->first();

                $link = $payment->payment_code;
                $link = '<a href="' . route('cart.view', $cart->cart_code) . '" title="">' . $cart->cart_code . '</a>';
                $content_success->content = str_replace('{$order_link}', $link, $content_success->content);
                // dd($content_success);
                $this->data['payment'] = $payment;
                $this->data['seo'] = [
                    'seo_title' => $content_success->title,

                ];
                $this->data['content_success'] = $content_success;
                return view($this->templatePath . '.payment.stripe_success', $this->data);
            }
        }
        return redirect(url('/'));
    }
    public function paymentCancel()
    {
        $content_success = \App\Models\Page::find(95);

        $this->data['seo'] = [
            'seo_title' => $content_success->title,

        ];
        $this->data['content_success'] = $content_success;
        return view($this->templatePath . '.payment.payment_cancel', $this->data);
    }
}
