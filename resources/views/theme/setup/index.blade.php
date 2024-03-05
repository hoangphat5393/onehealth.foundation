@extends('theme.layouts.index2')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@section('body-class', 'page-template-default page page-id-1940 wp-custom-logo theme-amaya woocommerce-js nomobile product-title-use-headline-font content-light')

@php
    // dd($data);
@endphp
@section('content')

    <section id="hero-mb-block-9069cc48-6311-4c00-ba97-e450e139db61" class="section section-hero  alignfull section-hero section-hero-image content-white has-overlay">
        <img decoding="async" class="hero-image hero-background hero-content-left hmobile-content-leave " src="{{ asset('images/setup.jpg') }}" alt="">
        <div class="hero-content-overlay">

            <div class="row justify-content-around w-100">
                <div class="col-lg-6">
                    <div class="hero-content section-content">
                        {{-- <div class="hero-content-item hero-subtitle subtitle-above use-body-font aos-init aos-animate h2">Dịch vụ setup quán</div> --}}
                        <h1 class="text-white mt-0" style="font-size: 5rem">Dịch vụ setup quán</h1>
                        <h2 class="hero-content-item hero-title aos-init aos-animate" data-aos="slide-up" style="margin-top: 12px;">
                            {{-- It all began with a modest concept: Create amazing coffee --}}
                            Tư vấn toàn diện<br>
                            Quản lý vận hành<br>
                            Hoạch định điểm hòa vốn
                        </h2>
                        <div class="hero-content-item hero-divider aos-init aos-animate" data-aos="fade-right"></div>
                        {{-- <div class="hero-content-item hero-text aos-init aos-animate" data-aos="fade-right" data-aos-delay="340">Coffee is our craft, our ritual, our passion and we want to share it with you.</div> --}}
                        <div class="hero-content-item hero-text aos-init aos-animate" data-aos="fade-right" data-aos-delay="340">Sáng tạo, hiệu quả, chuyên nghiệp</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="setup-form">
                        <h2 class="text-center">NHẬN TƯ VẤN MIỄN PHÍ</h2>
                        <p class="text-center">Để lại thông tin và trở thành chủ quán tự do nhờ quán tự vận hành</p>

                        <form id="contact_form" action="{{ route('setup.submit') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="contact[name]" placeholder="Họ tên">
                                <label for="name">Họ tên</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="phone" name="contact[phone]" placeholder="Số điện thoại">
                                <label for="phone">Số điện thoại</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="status" name="contact[status]" aria-label="Floating label select example">
                                    <option value="" selected>Tình trạng của quán</option>
                                    <option value="Đã có mặt bằng">Đã có mặt bằng</option>
                                    <option value="Chưa có mặt bằng">Chưa có mặt bằng</option>
                                    <option value="Đang xây quán">Đang xây quán</option>
                                </select>
                                <label for="status">Tình trạng của quán</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="content" name="contact[content]" style="height: 150px"></textarea>
                                <label for="content">Dịch vụ cần tư vấn</label>
                            </div>
                            <div class="submit-btn text-center">
                                <button type="submit" class="btn btn-submit-contact">Nhận tư vấn ngay</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="content" class="">
        <div class="container mt-4">
            @foreach ($service as $item)
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="entry-content">
                            <p class="h2">{{ $item->name }}</p>
                            @foreach ($item->setups as $item2)
                                <p class="question" style="font-size:18px">
                                    <strong>{{ $item2->name }}</strong>
                                </p>
                                <div class="answer px-4" style="display: none;">
                                    {!! htmlspecialchars_decode($item2->description) !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img class="img-fluid rounded-5" src="{{ get_image($item->image) }}" alt="">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
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
            "contact[status]": {
                required: "Vui lòng cho biết tình trạng quán",
            },
            "contact[phone]": {
                required: "Vui lòng số điện thoại hợp lệ",
                number: "Vui lòng cung cấp số điện thoại hợp lệ!!",
                digits: "Vui lòng cung cấp số điện thoại hợp lệ!!",
                minlength: "Vui lòng cung cấp số điện thoại hợp lệ!!",
            },
            "contact[subject]": "Vui lòng điền tiêu đề",
            "contact[message]": "Vui lòng nhập lời nhắn!"
        }

        contact_form.validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "contact[name]": "required",
                // "contact[email]": {
                //     required: true,
                //     email: true,
                // },
                // "contact[email_confirm]": {
                //     email: true,
                //     equalTo: "#cf-email"
                // },
                "contact[status]": "required",
                "contact[phone]": {
                    required: true,
                    number: true,
                    digits: true,
                    minlength: 10,
                },
                // "contact[subject]": "required",
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
