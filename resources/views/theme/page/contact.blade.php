@extends('theme.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

{{-- @section('body-class', 'page-template-default page page-id-1940') --}}

@section('content')
    <main id="contact">

        {{-- <h1 class="text-center">Liên hệ</h1> --}}

        <section class="block10">
            <div class="mainBanner">
                <div class="container main-menu">
                    @include('theme.includes.menu')
                </div>
                <div class="container-fluid px-0">
                    <div class="row g-0">
                        <div class="col-lg-12 banner-left">
                            <img class="img-fluid object-fit-cover w-100" src="{{ get_image($page->image) }}" alt="{{ $page->name }}">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Page content --}}
        <section class="block8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="category-title">{{ $page->title }}</h1>
                    </div>
                </div>
            </div>
        </section>

        {{-- <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <p>Cảm ơn sự quan tâm của bạn dành cho tổ chức của chúng tôi. Nếu như có bất cứ thắc mắc nào về các hoạt động cũng như thông tin về Quỹ, hãy gửi tin nhắn cho chúng tôi. Chúng tôi luôn chào đón và hồi đáp cho sự thắc mắc của bạn.</p>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <img class="w-100" src="{{ asset('images/map_google.jpg') }}">
                </div>
            </div>
        </div> --}}

        <div>
            {!! htmlspecialchars_decode($page->content) !!}
        </div>

        <section class="block14">
            <div class="container p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-8 address_info">
                        <div class="address_info_content p-3">
                            <h3 style="color: #00b0ae;font-size: 24px;font-weight: bolder">TRỤ SỞ CHÍNH</h3>
                            <p class="fw-bold">Hồ Chí Minh</p>
                            <p>{{ setting_option('address') }}</p>
                            <p class="mb-5">
                                PHONE: <a href="tel:{{ setting_option('phone') }}">{{ setting_option('phone') }}</a>
                                <br>
                                E-mail: <a href="mailto:{{ setting_option('email') }}">{{ setting_option('email') }}</a>
                            </p>
                            <h3 style="color: #00b0ae;font-size: 24px;font-weight: bolder">CHO QUYÊN GÓP</h3>
                            <p>
                                <b>Tài khoản ngân hàng: 100 0209 9482 0834</b>
                                <br>Ngân hàng Á Châu - ACB
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container d-none">
            <div class="row no-gutters">
                <div class="col-lg-8 col-md-7 d-flex align-items-stretch">
                    <div class="contact-wrap w-100 p-md-5 p-4">
                        <h3 class="mb-4">Get in touch</h3>
                        <div id="form-message-warning" class="mb-4"></div>
                        <div id="form-message-success" class="mb-4">
                            Your message was sent, thank you!
                        </div>
                        <form method="POST" id="contactForm" name="contactForm" class="contactForm" novalidate="novalidate">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label" for="name">Full Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" data-listener-added_48436227="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label" for="email">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="label" for="subject">Subject</label>
                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="label" for="#">Message</label>
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" value="Send Message" class="btn btn-primary">
                                        <div class="submitting"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                    <div class="info-wrap bg-primary w-100 p-md-5 p-4">
                        <h3>Let's get in touch</h3>
                        <p class="mb-4">We're open for any suggestion or just to have a chat</p>
                        <div class="dbox w-100 d-flex align-items-start">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-map-marker"></span>
                            </div>
                            <div class="text pl-3">
                                <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
                            </div>
                        </div>
                        <div class="dbox w-100 d-flex align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-phone"></span>
                            </div>
                            <div class="text pl-3">
                                <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
                            </div>
                        </div>
                        <div class="dbox w-100 d-flex align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-paper-plane"></span>
                            </div>
                            <div class="text pl-3">
                                <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                            </div>
                        </div>
                        <div class="dbox w-100 d-flex align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-globe"></span>
                            </div>
                            <div class="text pl-3">
                                <p><span>Website</span> <a href="#">yoursite.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="block15">
            <div class="container-fluid my-5">
                <div class="row justify-content-center">

                    <div class="col-lg-8 px-0">

                        <div class="contact_content p-5">
                            <p>
                                Hãy liên hệ cho chúng tôi nếu bạn có thắc mắc hoặc cần thêm thông tin chi tiết
                            </p>
                            <form id="contact_form" action="{{ route('contact.submit') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="mb-3">
                                    <label class="col-form-label " for="cf-name">Họ tên<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="cf-name" name="contact[name]" placeholder="Họ tên">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label" for="cf-email">@lang('Email')<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="cf-email" name="contact[email]" placeholder="@lang('Email')">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label" for="cf-subject">@lang('Phone')<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="cf-subject" name="contact[phone]" placeholder="@lang('Phone')">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label" for="cf-content">@lang('Message')<span class="text-danger">*</span></label>
                                    <textarea name="contact[content]" class="form-control bg-transparent" id="cf-content" rows="3" placeholder="@lang('Message')"></textarea>
                                </div>
                                <div class="submit-btn text-end">
                                    <button type="submit" class="btn btn-custom">Gửi</button>
                                    {{-- <input class="" type="submit" value="Send"> --}}
                                    {{-- <span class="wpcf7-spinner"></span> --}}
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <p class="text-start fs-4 fw-bold">Hoặc bạn muốn đồng hành</p>
                        <p class="text-start mb-3">Chúng tôi đang có nhu cầu tuyển dụng, bạn có thể trở thành thành viên của Quỹ từ thiện One Health Foundation</p>
                        <button class="mb-3" href="#" style="background: #00b0ae;padding: 5px 25px;color: #fff; border: 0px;">
                            <a class="text-white" href="#">Khám phá nghề nghiệp</a>
                        </button>
                        <br>
                        <button href="#" style="background: #fff;padding: 5px 15px;border: 1px solid #00b0ae; color: #00b0ae;">
                            <a href="#">Trở thành tình nguyện viên <i class="fa-solid fa-angle-right"></i></a>
                        </button>
                    </div>
                </div>
            </div>
        </section>


        {{-- Subscribe --}}
        @include('theme.includes.subscribe')
    </main>
@endsection

@push('scripts')
    <script>
        // CONTACT
        var contact_form = $("#contact_form");
        // var lc = '{{ app()->getLocale() }}';
        var error_messages = {};

        error_messages = {
            "contact[name]": "Vui lòng điền tên!",
            "contact[email]": {
                required: "Vui lòng điền địa chỉ email!",
                email: "Vui lòng nhập địa chỉ email hợp lệ",
            },
            "contact[email_confirm]": {
                email: "Vui lòng nhập địa chỉ email hợp lệ",
                equalTo: "Email không khớp"
            },
            "contact[phone]": {
                required: "Vui lòng số điện thoại hợp lệ",
                number: "Vui lòng cung cấp số điện thoại hợp lệ!!",
                digits: "Vui lòng cung cấp số điện thoại hợp lệ!!",
                minlength: "Vui lòng cung cấp số điện thoại hợp lệ!!",
            },
            "contact[subject]": "Vui lòng điền tiêu đề",
            "contact[content]": "Vui lòng nhập lời nhắn!"
        }

        contact_form.validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "contact[name]": "required",
                "contact[email]": {
                    required: true,
                    email: true,
                },
                // "contact[email_confirm]": {
                //     email: true,
                //     equalTo: "#cf-email"
                // },
                "contact[phone]": {
                    number: true,
                    digits: true,
                    minlength: 10,
                },
                "contact[subject]": "required",
                "contact[content]": "required",
            },
            messages: error_messages,
            errorElement: "div",
            errorLabelContainer: ".errorTxt",
            invalidHandler: function(event, validator) {
                $("html, body").animate({
                        scrollTop: contact_form.offset().top
                    },
                    500
                );
            },
        });
    </script>
@endpush
