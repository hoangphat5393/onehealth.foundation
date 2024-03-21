@extends($templatePath . '.layouts.index')

@section('content')
    <main id="main" class="register">
        [menu_no_banner]

        <section class="block17">
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="wrap">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <h4 class="fw-bold fs-4 text-main">Tạo tài khoản OneHealth Foundation</h4>
                                        <p>Hơn 5 triệu người đã đăng ký </p>
                                        <form id="customer_register" method="post" action="{{ route('postRegisterCustomer') }}">
                                            @csrf
                                            <div class="row mb-3 align-items-center">
                                                <div class="col-6">
                                                    <label for="username" class="col-form-label">@lang('First and last name')</label>
                                                    <input type="input" name="username" id="username" class="form-control" placeholder="@lang('We call you?')" aria-describedby="passwordHelpInline">
                                                </div>
                                                <div class="col-6">
                                                    <label for="birthday" class="col-form-label">@lang('Birthday')</label>
                                                    <input type="input" name="birthday" id="birthday" class="form-control" placeholder="@lang('Birthday')" aria-describedby="passwordHelpInline">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">@lang('Email')</label>
                                                <input type="email" class="form-control" id="email" placeholder="@lang('Email')" aria-describedby="email">
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone" class="form-label">@lang('Phone')</label>
                                                <input type="phone" class="form-control" id="phone" placeholder="@lang('Phone')" aria-describedby="phone">
                                            </div>

                                            <p class="form-note mb-3">
                                                OneHealth Foundation sẽ gửi bạn những hoạt động mới nhất thông qua tổng đài của chúng tôi, 028-710 77777. Bạn có thể nhận được 8 hoạt động mới nhất mỗi tháng từ chúng tôi.
                                                Tin nhắn và dung lượng có thể bị tính phí. Soạn HELP gửi 028-710 77777 nếu bạn có thắc mắc.
                                                Soạn STOP đến 028-710 77777 để từ chối nhận tin nhắn. Vui lòng xem lại trang Điều khoản dịch vụ và Chính sách bảo mật.
                                            </p>

                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">@lang('Password')</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="@lang('Password')">
                                            </div>

                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">@lang('Re-password')</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="@lang('Re-password')">
                                            </div>

                                            <button type="button" class="btn btn-custom btn-register">@lang('Create new account')</button>
                                            {{-- <button type="submit" class="btn btn-custom">@lang('Create new account')</button> --}}

                                            <p class="form-note text-center mt-4">
                                                Với việc đồng ý tạo tài khoản đồng nghĩa với bạn đã đồng ý với Điều khoản dịch vụ &amp; Chính sách bảo mật của chúng tôi và nhận thông tin cập nhật hàng tuần. Cước phí tin nhắn và dung lượng mạng có thể bị tính.
                                                Soạn STOP để từ chối nhận tin nhắn, HELP để nhờ trợ giúp
                                            </p>
                                            {{-- <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label footnote" for="exampleCheck1">
                                                    Với việc đồng ý tạo tài khoản đồng nghĩa với bạn đã đồng ý với Điều khoản dịch vụ &amp; Chính sách bảo mật của chúng tôi và nhận thông tin cập nhật hàng tuần. Cước phí tin nhắn và dung lượng mạng có thể bị tính.
                                                    Soạn STOP để từ chối nhận tin nhắn, HELP để nhờ trợ giúp
                                                </label>
                                            </div> --}}
                                        </form>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <img src="{{ asset('images/bg_register.jpg') }}" alt="login" class="img-fluid w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <div class="container d-none">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                    <div class="mb-4">
                        <form method="post" action="{{ route('postRegisterCustomer') }}" id="page-customer-register" class="contact-form">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="FirstName">First Name</label>
                                        <input type="text" name="firstname" placeholder="" id="FirstName" autofocus="">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="LastName">Last Name</label>
                                        <input type="text" name="lastname" placeholder="" id="LastName">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" placeholder="" id="phone">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="CustomerEmail">Email</label>
                                        <input type="email" name="email" placeholder="" id="CustomerEmail" class="" autocorrect="off" autocapitalize="none" autofocus="">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="CustomerPassword">Password</label>
                                        <input type="password" value="" name="password" placeholder="" id="CustomerPassword" class="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-sm-12">
                                    <div class="error-message"></div>
                                </div>
                                <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                    <button type="button" class="btn mb-3 btn-register">@lang('Create')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Subscribe --}}
        @include('theme.includes.subscribe')

    </main>
@endsection

@push('scripts')
    <script>
        var customer_register = $("#customer_register");
        var lc = '{{ app()->getLocale() }}';

        $(document).ready(function($) {
            customer_register.validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,
                rules: {
                    last_name: "required",
                    phone: "required",
                    email: "required",
                    password: "required"
                },
                messages: {
                    last_name: "@lang('Enter Last name')",
                    phone: "Nhập số điện thoại",
                    email: "Nhập địa chỉ E-mail",
                    password: "Nhập mật khẩu"
                },
                errorElement: 'div',
                errorLabelContainer: '.errorTxt',
                invalidHandler: function(event, validator) {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
                }
            });
            // $('.btn-register').on('click', function(event) {
            //     form_id = $('#page-customer-register');
            //     if (form_id.valid()) {

            //         form_id.find('.list-content-loading').show();
            //         var form = document.getElementById('page-customer-register');
            //         var fdnew = new FormData(form);

            //         axios({
            //             method: 'POST',
            //             url: form_id.prop("action"),
            //             data: fdnew,
            //         }).then(res => {
            //             var url_back = '';

            //             if (res.data.error == 0) {
            //                 url_back = res.data.redirect_back;
            //                 $('.page-register-content').html(res.data.view);
            //             } else {
            //                 form_id.find('.error-message').html(res.data.msg);
            //                 form_id.find('.list-content-loading').hide();
            //             }
            //         }).catch(e => console.log(e));
            //     }
            // });
        });
    </script>
@endpush
