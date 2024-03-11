<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- <title><?php echo e(setting_option('company_name')); ?></title>
    <meta name="description" content="description"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="shortcut icon" href="<?php echo e(get_image(setting_option('favicon'))); ?>" />

    
    <?php echo $__env->yieldContent('seo'); ?>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Outline&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap.min.css')); ?>">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    
    <link rel="stylesheet" href="<?php echo e(asset('plugin/animate/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugin/swiper@11/swiper-bundle.min.css')); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css?ver=' . random_int(0, 100))); ?>">

    <?php echo htmlspecialchars_decode(setting_option('header')); ?>


    <?php echo $__env->yieldPushContent('head-style'); ?>
    <?php echo $__env->yieldPushContent('head-script'); ?>
</head>

<body>

    
    <?php echo $__env->make($templateFile . '.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    

    <?php echo $__env->make($templateFile . '.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <script src="<?php echo e(asset('js/jquery-3.7.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/bootstrap.bundle.min.js')); ?> "></script>
    
    <script src="<?php echo e(asset('plugin/axios.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugin/jquery-validation/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugin/swiper@11/swiper-bundle.min.js')); ?>"></script>

    <script src="<?php echo e(asset('plugin/aos/aos.js')); ?>"></script>
    <script src="<?php echo e(asset('plugin/wow/wow.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugin/counterup/counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugin/waypoints/waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugin/sweetalert2@11/sweetalert2.all.min.js')); ?>"></script>


    <script src="<?php echo e(asset('js/main.js?ver=' . random_int(0, 100))); ?>"></script>
    <script src="<?php echo e(asset('js/custom.js?ver=' . random_int(0, 100))); ?>"></script>

    

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH F:\web\onehealth.foundation\resources\views/theme/layouts/index.blade.php ENDPATH**/ ?>