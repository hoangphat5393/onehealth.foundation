@extends($templatePath . '.layouts.index')

@section('content')
    <main id="main" class="register">
        [menu_no_banner]

        <section class="block17 page-register-content">
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="wrap">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-5">

                                        <h4 class="fw-bold fs-4 text-main">Tạo tài khoản OneHealth Foundation</h4>
                                        <p>Hơn 5 triệu người đã đăng ký</p>

                                        <form id="customer_register" method="post" action="{{ route('postRegisterCustomer') }}">
                                            @csrf
                                            <div class="row mb-3 align-items-center">
                                                <div class="col-6">
                                                    <label for="username" class="col-form-label">@lang('First and last name')</label>
                                                    <input type="input" name="username" id="username" class="form-control" placeholder="@lang('We call you?')" aria-describedby="username">
                                                </div>
                                                <div class="col-6">
                                                    <label for="birthday" class="col-form-label">@lang('Birthday')</label>
                                                    <input type="input" name="birthday" id="birthday" class="form-control" placeholder="@lang('Birthday')" aria-describedby="birthday">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">@lang('Email')</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="@lang('Email')" aria-describedby="email">
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone" class="form-label">@lang('Phone')</label>
                                                <input type="phone" name="phone" id="phone" class="form-control" placeholder="@lang('Phone')" aria-describedby="phone">
                                            </div>

                                            <p class="form-note mb-3">
                                                OneHealth Foundation sẽ gửi bạn những hoạt động mới nhất thông qua tổng đài của chúng tôi, 028-710 77777. Bạn có thể nhận được 8 hoạt động mới nhất mỗi tháng từ chúng tôi.
                                                Tin nhắn và dung lượng có thể bị tính phí. Soạn HELP gửi 028-710 77777 nếu bạn có thắc mắc.
                                                Soạn STOP đến 028-710 77777 để từ chối nhận tin nhắn. Vui lòng xem lại trang Điều khoản dịch vụ và Chính sách bảo mật.
                                            </p>

                                            <div class="mb-3">
                                                <label for="password" class="form-label">@lang('Password')</label>
                                                <input type="password" id="password" class="form-control" name="password" placeholder="@lang('Password')">
                                            </div>

                                            <div class="mb-3">
                                                <label for="password_confirm" class="form-label">@lang('Re-password')</label>
                                                <input type="password" id="password_confirm" class="form-control" name="password_confirm" placeholder="@lang('Re-password')">
                                            </div>

                                            <button type="button" class="btn btn-custom btn-register">@lang('Create new account')</button>
                                            {{-- <button type="submit" class="btn btn-custom">@lang('Create new account')</button> --}}

                                            <p class="form-note text-center mt-4">
                                                Với việc đồng ý tạo tài khoản đồng nghĩa với bạn đã đồng ý với Điều khoản dịch vụ &amp; Chính sách bảo mật của chúng tôi và nhận thông tin cập nhật hàng tuần. Cước phí tin nhắn và dung lượng mạng có thể bị tính.
                                                Soạn STOP để từ chối nhận tin nhắn, HELP để nhờ trợ giúp
                                            </p>

                                            <div class="mb-3">
                                                <div class="error-message"></div>
                                            </div>
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

        {{-- Subscribe --}}
        @include('theme.includes.subscribe')

    </main>
@endsection

@push('scripts')
    <script>
        var customer_register = $("#customer_register");
        var lc = '{{ app()->getLocale() }}';
        var register_success = '{{ route('user.register.success') }}';

        var error_messages = {};

        if (lc == 'vi') {
            error_messages = {
                username: "@lang('Enter Last name')",
                birthday: "Nhập ngày ngày sinh",
                phone: "Nhập số điện thoại",
                email: "Nhập địa chỉ E-mail",
                password: "Nhập @lang('Password')",
                password_confirm: "Nhập @lang('Password')"
            }
        } else {
            error_messages = {
                username: "@lang('Enter Last name')",
                birthday: "Nhập ngày ngày sinh",
                phone: "Nhập số điện thoại",
                email: "Nhập địa chỉ E-mail",
                password: "Nhập @lang('Password')",
                password_confirm: "Nhập @lang('Password')"
            }
        }

        $(document).ready(function($) {
            customer_register.validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,
                rules: {
                    username: "required",
                    birthday: "required",
                    phone: "required",
                    email: "required",
                    password: "required",
                    password_confirm: {
                        required: true,
                        equalTo: '#password',
                    },
                    password_confirm: "required",
                },
                messages: error_messages,
                errorElement: 'div',
                errorLabelContainer: '.errorTxt',
                invalidHandler: function(event, validator) {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
                }
            });

            $('.btn-register').on('click', function(event) {
                if (customer_register.valid()) {
                    // customer_register.find('.list-content-loading').show();
                    var form = document.getElementById('customer_register');
                    var fdnew = new FormData(form);
                    axios({
                        method: 'POST',
                        url: customer_register.prop("action"),
                        data: fdnew,
                    }).then(res => {
                        if (res.data.status == "success") {
                            // $('.page-register-content').html(res.data.view);
                            window.location.replace(register_success);
                        } else {
                            customer_register.find('.error-message').html(res.data.msg);
                            // customer_register.find('.list-content-loading').hide();
                        }
                    }).catch(e => console.log(e));
                }
            });
        });
    </script>
@endpush
