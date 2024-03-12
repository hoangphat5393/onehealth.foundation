<section class="block7">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="subscribe-block p-4">
                    <h4><?php echo app('translator')->get('Electronic newsletter'); ?></h4>
                    
                    <form id="subscription_form" action="<?php echo e(route('subscription')); ?>" method="post" class="" novalidate="novalidate">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-5">
                                <label for="email" class="visually-hidden">Email</label>
                                <input type="email" class="form-control border-custom" id="email" name="subscription[email]" placeholder="<?php echo app('translator')->get('Your email'); ?>">
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-custom btn-subscription"><?php echo app('translator')->get('Register'); ?></button>
                                <span class="ajax-loader"></span>
                            </div>
                        </div>
                    </form>
                    <p class="my-3"><?php echo app('translator')->get('Recieve news'); ?> One Health Foundation</p>
                    <div class="d-flex align-items-center">
                        <p><?php echo app('translator')->get('Follow us'); ?></p>
                        &emsp;&emsp;
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="<?php echo e(setting_option('facebook')); ?>" target="_blank">
                                    <img src="https://onehealth.foundation/wp-content/themes/thewish/img/icon/fb.png">
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php echo e(setting_option('twitter')); ?>" target="_blank">
                                    <img src="https://onehealth.foundation/wp-content/themes/thewish/img/icon/twitter.png">
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php echo e(setting_option('youtube')); ?>" target="_blank">
                                    <img src="https://onehealth.foundation/wp-content/themes/thewish/img/icon/youtube.png">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $__env->startPush('scripts'); ?>
    <script>
        $("#subscription_form").submit(function(e) {
            e.preventDefault();
        });
        // SUBSCRIPTION
        $(".btn-subscription").on("click", function() {
            var action = $(this).closest("form").attr("action"),
                email = $(this).closest("form").find('input[name="subscription[email]"]').val();

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
                            title: res.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('input[name="subscription[email]"]').val();
                    } else {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: res.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
                .catch((e) => console.log(e));
            // if (email) {
            //     axios({
            //             method: "post",
            //             url: action,
            //             data: {
            //                 email: email
            //             },
            //         })
            //         .then((res) => {
            //             if (res.data.status == "success") {
            //                 Swal.fire({
            //                     position: "center",
            //                     icon: "success",
            //                     title: res.data.message,
            //                     showConfirmButton: false,
            //                     timer: 1500
            //                 });
            //                 $('input[name="subscription[email]"]').val();
            //             } else {
            //                 Swal.fire({
            //                     position: "center",
            //                     icon: "error",
            //                     title: res.data.message,
            //                     showConfirmButton: false,
            //                     timer: 1500
            //                 });
            //             }
            //         })
            //         .catch((e) => console.log(e));
            // }
            // else {
            //     alertMsg('error', "Vui lòng nhập Email");
            //     $('input[name="subscription[email]"]').focus();
            // }
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH F:\web\onehealth.foundation\resources\views/theme/includes/subscribe.blade.php ENDPATH**/ ?>