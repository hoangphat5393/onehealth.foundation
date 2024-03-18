@extends('theme.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

{{-- @section('body-class', 'page-template-default page page-id-1940') --}}

@section('content')
    <main id="contact">

        {{-- Page content --}}
        {!! htmlspecialchars_decode($page->content) !!}

        <section class="block14">
            <div class="container p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-8 address_info">
                        <div class="address_info_content p-3">
                            <h4 class="fw-bold text-uppercase" style="color: #00b0ae;">@lang('Headquarters')</h4>
                            <p class="fw-bold">@lang('Ho Chi Minh')</p>
                            <p>{{ setting_option('address') }}</p>
                            <p class="mb-5">
                                @lang('Phone'): <a href="tel:{{ setting_option('phone') }}">{{ setting_option('phone') }}</a>
                                <br>
                                @lang('E-mail'): <a href="mailto:{{ setting_option('email') }}">{{ setting_option('email') }}</a>
                            </p>
                            <h4 class="fw-bold text-uppercase" style="color: #00b0ae;">@lang('For donation')</h4>
                            <p>
                                <strong>@lang('Bank account'): {{ setting_option('bank_account') }}</strong>
                                <br>
                                <strong>@lang('Bank'):</strong> {{ setting_option('bank_name') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="block15">
            <div class="container-fluid my-5">
                <div class="row justify-content-center">

                    <div class="col-lg-8 px-0 mb-5">

                        <div class="contact_content p-4">

                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <p>@lang('Contact text')</p>
                                    <form id="contact_form" action="{{ route('contact.submit') }}" method="post" novalidate="novalidate">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="col-form-label " for="cf-name">@lang('First and last name')<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="cf-name" name="contact[name]" placeholder="@lang('First and last name')">
                                        </div>
                                        <div class="mb-3">
                                            <div class="row row-cols-1 row-cols-lg-2">
                                                <div class="col">
                                                    <label class="col-form-label" for="cf-email">@lang('Email')<span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="cf-email" name="contact[email]" placeholder="@lang('Email')">
                                                </div>

                                                <div class="col">
                                                    <label class="col-form-label" for="cf-subject">@lang('Phone')<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="cf-subject" name="contact[phone]" placeholder="@lang('Phone')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label" for="cf-content">@lang('Message')<span class="text-danger">*</span></label>
                                            <textarea name="contact[content]" class="form-control" id="cf-content" rows="8" placeholder="@lang('Message')"></textarea>
                                        </div>
                                        <div class="submit-btn text-end">
                                            <button type="submit" class="btn btn-custom">@lang('Submit')</button>
                                            {{-- <input class="" type="submit" value="Send"> --}}
                                            {{-- <span class="wpcf7-spinner"></span> --}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 text-end">
                        <p class="text-start fs-4 fw-bold">@lang('Contact text 1')</p>
                        <p class="text-start mb-3">@lang('Contact text 2')</p>
                        <button class="mb-3" href="#" style="background: #00b0ae;padding: 5px 25px;color: #fff; border: 0px;">
                            <a class="text-white" href="#">@lang('Explore careers')</a>
                        </button>
                        <br>
                        <button href="#" style="background: #fff;padding: 5px 15px;border: 1px solid #00b0ae; color: #00b0ae;">
                            <a href="#">@lang('Become a volunteer') <i class="fa-solid fa-angle-right"></i></a>
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
        var lc = '{{ app()->getLocale() }}';
        var error_messages = {};

        if (lc == 'vi') {
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
        } else {
            error_messages = {
                "contact[name]": "Please fill in you name!",
                "contact[email]": {
                    required: "Please fill in your email address!",
                    email: "Please enter valid email address",
                },
                "contact[email_confirm]": {
                    email: "Please enter valid email address",
                    equalTo: "Email does not match"
                },
                "contact[phone]": {
                    required: "Please enter valid phone number",
                    number: "Please provide valid phone number!!",
                    digits: "Please provide valid phone number!!",
                    minlength: "Please provide valid phone number!!",
                },
                "contact[subject]": "Please fill in the box",
                "contact[message]": "Please fill in message!"
            }
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
