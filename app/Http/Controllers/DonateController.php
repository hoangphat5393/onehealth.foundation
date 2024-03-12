<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\Models\EmailTemplate;
use App\Models\Contact;

class DonateController extends Controller
{
    use \App\Traits\LocalizeController;

    public $data = [
        'error' => false,
        'success' => false,
        'message' => ''
    ];

    public function index()
    {
        $this->localized();
        $this->data['page'] = \App\Page::where('slug', 'contact')->first();
        // return view($this->templatePath . '.contact.index', ['data' => $this->data]);
        return view('theme.donate.index', ['data' => $this->data]);
    }

    public function bankpaypal()
    {
        $this->localized();
        // $this->data['page'] = \App\Page::where('slug', 'contact')->first();
        // return view('theme.donate.index', ['data' => $this->data]);
        return view('theme.page.paypal');
    }

    // public function banktransfer()
    // {
    //     $this->localized();
    //     return view('theme.page.donate-transfer');
    // }

    public function confirmation(Request $rq)
    {
        $this->localized();
        $detail = $rq->input('donate');
        if ($detail) {
            $this->data['data'] = $detail;
            // return view($this->templatePath . '.contact.confirmation', $this->data)->compileShortcodes();
            return view($this->templatePath . '.donate.confirmation', $this->data);
        }
    }

    public function getContact(Request $request, $type)
    {
        if ($type == 'request-contact') {
            $this->data['status'] = 'success';
            $this->data['type'] = $type;
            $this->data['url_current'] = $request->url_current;
            $this->data['product_title'] = $request->product_title;
            $this->data['view'] = view('theme.page.includes.get-contact-form', ['data' => $this->data])->render();
        }
        return response()->json($this->data);
    }

    public function submit(Request $rq)
    {
        $detail = $rq->input('donate', false);

        if ($detail) {

            $this->data['data'] = $detail;

            $mail_customer = EmailTemplate::where('group', 'contact_admin')->first();
            $mail_content = $mail_customer->text;

            $data = array(
                'name' => $detail['name'],
                // 'address' => $detail['address'],
                'email' => $detail['email'],
                'phone' => $detail['phone'],
                // 'course' => $detail['course'],
                'content' => $detail['content'],
            );

            // Mail content 
            $dataFind = [
                '/\{\{\$name\}\}/',
                // '/\{\{\$address\}\}/',
                '/\{\{\$email\}\}/',
                '/\{\{\$phone\}\}/',
                // '/\{\{\$course\}\}/',
                '/\{\{\$content\}\}/',
            ];
            $mail_content = preg_replace($dataFind, $data, $mail_content);

            // Save contact
            $data['type'] = 'contact';
            $respons = Contact::create($data);
            $insert_id = $respons->id;
            // if sort = 0 => update sort = id
            Contact::where("id", $insert_id)->update(['sort' => $insert_id]);

            // if (app()->getLocale() == 'vi') {
            //     $sub = setting_option('company_name_vi');
            //     $from_mail = [setting_option('smtp-from-address'), setting_option('company_name_vi') ?? ''];
            // } else {
            //     $sub = setting_option('company_name');
            //     $from_mail = [setting_option('smtp-from-address'), setting_option('company_name') ?? ''];
            // }

            $sub = setting_option('webtitle');
            $from_mail = [setting_option('email_admin'), setting_option('webtitle') ?? ''];


            $subject = $sub . 'Đăng ký tư vấn' . ' (' . date('Y-m-d H:i:s') . ')';

            // Email thông báo gửi khách hàng
            Mail::send(
                [],
                [],
                function ($message) use ($data, $from_mail, $subject, $mail_content) {
                    $message->from($from_mail[0])
                        ->to($data['email'])
                        ->subject($subject)
                        ->html(htmlspecialchars_decode($mail_content));
                    // ->text('html');
                }
            );

            // Thông báo tới admin, có khách hàng liên hệ
            $sendToAdmin = setting_option('email_admin');
            Mail::send(
                [],
                [],
                function ($message) use ($data, $from_mail, $sendToAdmin, $subject, $mail_content) {
                    $message->from($from_mail[0])
                        ->to($sendToAdmin)
                        ->subject($subject)
                        ->html(htmlspecialchars_decode($mail_content));
                    // ->text('html');
                }
            );

            // return redirect()->route('contact_completed', ['name' => $detail['name']]);
            return redirect()->route('contact_completed')->with('contact_name', $detail['name']);
            // return view($this->templatePath . '.donate.completed', $this->data);
        }
    }

    public function completed(Request $request)
    {
        return view($this->templatePath . '.donate.completed');
        // $this->localized();
        // $detail = $request->all();
        // if ($detail) {
        //     $this->data['data'] = $detail;
        //     return view($this->templatePath . '.contact.completed', $this->data)->compileShortcodes();
        // } else {
        //     return redirect('/');
        // }
    }
}
