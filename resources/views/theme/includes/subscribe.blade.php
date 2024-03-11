<section class="block7">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 subscribe-block p-4">
                <h4>@lang('Electronic newsletter')</h4>
                <div role="form" class="wpcf7" id="wpcf7-f2105-o1" lang="en-US" dir="ltr">
                    <div class="screen-reader-response">
                        <p role="status" aria-live="polite" aria-atomic="true"></p>
                        <ul></ul>
                    </div>
                    {{-- {{ route('subscription') }} --}}
                    <form id="subscription_form" action="{{ route('subscription') }}" method="post" class="" novalidate="novalidate">
                        @csrf
                        <div class="row">
                            <div class="col-5">
                                <label for="email" class="visually-hidden">Email</label>
                                <input type="email" class="form-control border-custom" id="email" name="subscription[email]" placeholder="@lang('Your email')">
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-custom btn-subscription">@lang('Register')</button>
                                <span class="ajax-loader"></span>
                            </div>
                        </div>
                    </form>
                </div>

                <p class="my-3">@lang('Recieve news') One Health Foundation</p>
                <div class="d-flex align-items-center">
                    <p>@lang('Follow us')</p>
                    &emsp;&emsp;
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ setting_option('facebook') }}" target="_blank">
                                <img src="https://onehealth.foundation/wp-content/themes/thewish/img/icon/fb.png">
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ setting_option('twitter') }}" target="_blank">
                                <img src="https://onehealth.foundation/wp-content/themes/thewish/img/icon/twitter.png">
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ setting_option('youtube') }}" target="_blank">
                                <img src="https://onehealth.foundation/wp-content/themes/thewish/img/icon/youtube.png">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


@push('scripts')
    <script>
        // Swal.fire({
        //     position: "center",
        //     icon: "success",
        //     title: "Đăng ký thành công",
        //     showConfirmButton: false,
        //     timer: 1500
        // });

        // SUBSCRIPTION
        $(".btn-subscription").on("click", function() {
            var action = $(this).closest("form").attr("action"),
                email = $(this).closest("form").find('input[name="subscription[email]"]').val();

            console.log(action, email);
            if (email) {
                axios({
                        method: "post",
                        url: action,
                        data: {
                            email: email
                        },
                    })
                    .then((res) => {
                        if (res.data.status == "success") {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Đăng ký thành công",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('input[name="subscription[email]"]').val();
                        }
                    })
                    .catch((e) => console.log(e));
            } else {
                alertMsg('error', "Vui lòng nhập Email");
                $('input[name="subscription[email]"]').focus();
            }
        });

        // var subscription_form = $("#subscription_form");
        // var error_messages = {};

        // error_messages = {
        //     "subscription[email]": {
        //         required: "Vui lòng điền địa chỉ email!",
        //         email: "Vui lòng nhập địa chỉ email hợp lệ",
        //     },
        // }

        // subscription_form.validate({
        //     onfocusout: false,
        //     onkeyup: false,
        //     onclick: false,
        //     rules: {
        //         "subscription[email]": {
        //             required: true,
        //             email: true,
        //         },
        //     },
        //     messages: error_messages,
        //     errorElement: "div",
        //     errorLabelContainer: ".errorTxt",
        //     invalidHandler: function(event, validator) {
        //         $("html, body").animate({
        //                 scrollTop: subscription_form.offset().top
        //             },
        //             500
        //         );
        //     },
        // });

        // $(".btn-login").on("click", function(event) {
        //     if (login_popup.valid()) {
        //         var form = document.getElementById("signin-tab");
        //         var fdnew = new FormData(form);
        //         login_popup.find(".list-content-loading").show();
        //         axios({
        //                 method: "POST",
        //                 url: "/auth/login",
        //                 data: fdnew,
        //             })
        //             .then((res) => {
        //                 // console.log(res.data);
        //                 login_popup.find(".error-message").hide();
        //                 if (res.data.error == 0) {
        //                     $("#signin-tab").html(res.data.view);

        //                     $("#signin-modal").on("hidden.bs.modal", function(e) {
        //                         window.location.href = res.data.redirect_back;
        //                     });
        //                 } else {
        //                     login_popup.find(".list-content-loading").hide();
        //                     login_popup.find(".error-message").show().html(res.data.msg);
        //                 }
        //                 // login_page.find('.list-content-loading').hide();
        //             })
        //             .catch((e) => console.log(e));
        //     }
        // });
    </script>
@endpush
