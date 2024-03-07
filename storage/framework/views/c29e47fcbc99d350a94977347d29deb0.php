<section class="block7">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 subscribe-block p-4">
                <h4>Bản tin điện tử</h4>
                <div role="form" class="wpcf7" id="wpcf7-f2105-o1" lang="en-US" dir="ltr">
                    <div class="screen-reader-response">
                        <p role="status" aria-live="polite" aria-atomic="true"></p>
                        <ul></ul>
                    </div>
                    <form action="" method="post" class="" novalidate="novalidate">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-5">
                                <label for="email" class="visually-hidden">Password</label>
                                <input type="email" class="form-control border-custom" id="inputPassword2" placeholder="Địa chỉ email của bạn">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-custom">Đăng ký</button>
                                <span class="ajax-loader"></span>
                            </div>
                        </div>
                        
                    </form>
                </div>

                <p class="my-3">Để nhận những thông tin mới nhất về One Health Foundation</p>
                <div class="d-flex">
                    <p>Theo dõi chúng tôi</p>
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
</section>
<?php /**PATH F:\web\onehealth.foundation\resources\views/theme/includes/subscribe.blade.php ENDPATH**/ ?>