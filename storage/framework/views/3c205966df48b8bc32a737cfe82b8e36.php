<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(setting_option('favicon')); ?>" />

    <?php echo $__env->yieldContent('seo'); ?>

    <!-- Google Font: Source Sans Pro -->
    

    <!-- Font Awesome 6.4.2 -->
    <link rel="stylesheet" href="<?php echo e(asset('fontawesome_pro/css/all.min.css')); ?>">

    
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- AdminLTE v3.2.0 Css -->
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/adminlte.css?ver=' . time())); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('plugin/datetimepicker/jquery.datetimepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugin/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('plugin/bootstrap4-toggle/bootstrap4-toggle.min.css')); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('plugin/jquery-ui/jquery-ui.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('plugin/jquery-confirm-v3.3.4/jquery-confirm.min.css')); ?>">

    <!-- Admin Custom Css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/style_admin.css?ver=' . time())); ?>">

    <?php echo $__env->yieldPushContent('style'); ?>

    <?php echo $__env->yieldPushContent('head-script'); ?>

</head>

<body>
    <?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo e(route('index')); ?>" class="nav-link">Home</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <div class="content-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    

    <?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main js -->
    <script src="<?php echo e(asset('js/jquery-3.7.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap-4.6.2/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugin/axios.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugin/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/adminlte.js?ver=' . time())); ?>"></script>

    <script src="<?php echo e(asset('plugin/ckeditor/ckeditor.js')); ?>"></script>
    <script src="<?php echo e(asset('plugin/ckfinder/ckfinder.js')); ?>"></script>

    <script src="<?php echo e(asset('plugin/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugin/datetimepicker/jquery.datetimepicker.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugin/jquery-validation/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugin/jquery-confirm-v3.3.4/jquery-confirm.min.js')); ?>"></script>

    
    <script src="<?php echo e(asset('plugin/bootstrap4-toggle/bootstrap4-toggle.min.js')); ?>"></script>

    
    <script src="<?php echo e(asset('js/js_admin.js?ver=' . time())); ?>"></script>

    <script>
        CKEDITOR.editorConfig = function(config) {
            config.pasteFromWordPromptCleanup = true;
            config.pasteFromWordRemoveFontStyles = false;
            config.pasteFromWordRemoveStyles = false;
            // config.extraPlugins = 'imagepaste';
            // config.extraPlugins = 'tab';
            // config.removePlugins = 'resize';
            // config.resize_enabled = false;
            // config.disableObjectResizing = true;
        };

        CKFinder.config({
            connectorPath: '/ckfinder/connector',
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>

    <?php echo $__env->yieldPushContent('scripts-footer'); ?>

</body>

</html>
<?php /**PATH F:\web\onehealth.foundation\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>