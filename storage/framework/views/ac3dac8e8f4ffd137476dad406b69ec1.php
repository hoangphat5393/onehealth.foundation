<?php
    // if (Auth::check()) {
    //     $user = Auth::user();
    //     $avatar = public_path('img/users/avatar/') . $user->avatar;
    // }
?>

<header id="header" class="header">
    <div class="container mb-5">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?php echo e(Route::localizedUrl('vi')); ?>">Tiếng Việt</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(Route::localizedUrl('en')); ?>">English</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Đăng nhập</a>
            </li>
        </ul>
    </div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <a href="<?php echo e(route('index')); ?>" rel="home">
                    <img src="<?php echo e(get_image(setting_option('logo'))); ?>" class="logo" alt="<?php echo e(setting_option('webtitle')); ?>" style="height:84px">
                </a>
            </div>
            <div class="col-lg-6 text-end">
                <a href="<?php echo e(route('index')); ?>" rel="home">
                    <img src="<?php echo e(asset('images/create_campain.png')); ?>" class="logo" alt="<?php echo e(setting_option('webtitle')); ?>" style="height:54px">
                </a>
            </div>
        </div>
    </div>
</header>
<?php /**PATH F:\web\onehealth.foundation\resources\views/theme/layouts/header.blade.php ENDPATH**/ ?>