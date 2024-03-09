@extends('theme.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@section('body-class', 'page-template-default page page-id-1940 wp-custom-logo theme-amaya woocommerce-js nomobile product-title-use-headline-font content-light')

{{-- @php
    dd($page);
@endphp --}}
@section('content')
    <main>
        <div id="content" class="site-content no-sidebar regular has-">
            <div class="container">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main  ">
                        <article id="post-1940" class="post-1940 page type-page status-publish hentry">
                            <h1 class=" text-center">Liên hệ</h1>

                            <p class="has-text-align-center">
                                Liên hệ để nhận tư vấn
                            </p>

                            <div class="row justify-content-center">
                                <div class="col-lg-6">

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
                                        {{-- <div class="mb-3">
                                            <label class="col-form-label" for="cf-subject">@lang('Subject')<span class="text-danger">*</span></label>
                                            <select class="form-control" id="businesstype" aria-required="true" aria-invalid="false" name="your-business-type">
                                                <option value="Cafe">Cafe</option>
                                                <option value="Restaurant">Restaurant</option>
                                                <option value="Office">Office</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div> --}}
                                        <div class="mb-3">
                                            <label class="col-form-label" for="cf-content">@lang('Message')<span class="text-danger">*</span></label>
                                            <textarea name="contact[content]" class="form-control bg-transparent" id="cf-content" rows="3" placeholder="@lang('Message')"></textarea>
                                        </div>
                                        <div class="submit-btn text-end">
                                            <button type="submit" class="btn btn-submit-contact">Gửi</button>
                                            {{-- <input class="" type="submit" value="Send"> --}}
                                            {{-- <span class="wpcf7-spinner"></span> --}}
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </article>
                    </main>
                </div>
            </div>
        </div>
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

    {{-- <script>
        (function() {
            window.mc4wp = window.mc4wp || {
                listeners: [],
                forms: {
                    on: function(evt, cb) {
                        window.mc4wp.listeners.push({
                            event: evt,
                            callback: cb
                        });
                    }
                }
            }
        })();
    </script> --}}
@endpush
