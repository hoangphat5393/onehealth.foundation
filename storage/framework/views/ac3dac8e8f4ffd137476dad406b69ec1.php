<?php
    // if (Auth::check()) {
    //     $user = Auth::user();
    //     $avatar = public_path('img/users/avatar/') . $user->avatar;
    // }
?>

<header id="header" class="header">
    <div class="container mb-3">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?php echo e(Route::localizedUrl('vi')); ?>"><?php echo app('translator')->get('Viet Nam'); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(Route::localizedUrl('en')); ?>"><?php echo app('translator')->get('English'); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true"><?php echo app('translator')->get('Login'); ?></a>
            </li>
        </ul>
    </div>

    <?php
        $headerMenu = \App\Models\Menus::where('name', 'Menu-main')->first();
    ?>

    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('index')); ?>">
                <img src="<?php echo e(get_image(setting_option('logo'))); ?>" class="logo" alt="<?php echo e(setting_option('webtitle')); ?>" style="height:84px">
            </a>
            <div class="d-none d-lg-block">
                <a href="<?php echo e(route('page', 'donate')); ?>">
                    <img src="<?php echo e(asset('images/create_campain.png')); ?>" class="logo" alt="<?php echo e(setting_option('webtitle')); ?>" style="height:54px">
                </a>
            </div>

            <button class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                        <?php $__currentLoopData = $headerMenu->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $hasChild = $item->child()->exists(); ?>

                            <?php if($hasChild != 1): ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="<?php echo e($item->link); ?>"><?php echo e($item->label); ?></a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo e($item->label); ?>

                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php $__currentLoopData = $item->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a class="dropdown-item" href="<?php echo e($item->link); ?>"><?php echo e($item2->label); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <form class="d-flex" role="search" method="get" action="<?php echo e(route('search')); ?>">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control input-search" placeholder="<?php echo app('translator')->get('Search'); ?>" aria-label="<?php echo app('translator')->get('Search'); ?>" aria-describedby="basic-addon2">
                            <button type="submit" class="input-group-text btn-search" id="search"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>
<?php /**PATH F:\web\onehealth.foundation\resources\views/theme/layouts/header.blade.php ENDPATH**/ ?>