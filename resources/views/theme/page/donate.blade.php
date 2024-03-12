@extends('theme.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

{{-- @section('body-class', 'page-template-default page page-id-1940') --}}

@section('content')
    <main id="donate">
        <section class="block10" style="background:#20a19f;height: 100px;">
            <div class="mainBanner">
                <div class="container main-menu">
                    @include('theme.includes.menu')
                </div>
                {{-- <div class="container-fluid px-0">
                    <div class="row g-0">
                        <div class="col-lg-12 banner-left">
                            <img class="img-fluid object-fit-cover w-100" src="{{ get_image($page->image) }}" alt="{{ $page->name }}">
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>

        {{-- Page content --}}
        <section class="block8 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="text-main">{{ $page->title }}</h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="content">
            {!! htmlspecialchars_decode($page->content) !!}
        </div>

        <section class="block15">
            <div class="container-fluid my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <p class="fs-2 text-main text-uppercase fw-bold mb-3">Thông tin ngân hàng</p>
                        <a href="{{ route('page', 'bank-paypal') }}"><img src="{{ asset('images/payment/paypal.jpg') }}" class="img-fluid w-100 mb-3" alt="paypal" /></a>
                        <a href="{{ route('page', 'bank-transfer') }}"><img src="{{ asset('images/payment/bank.jpg') }}" class="img-fluid w-100" alt="bank" /></a>
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
