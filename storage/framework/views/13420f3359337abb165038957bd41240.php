

<?php $__env->startSection('content'); ?>
    
    <section class="space-ptb bg-holder my-5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="error-404 text-center">
                        <h1>404</h1>
                        <strong>Trang bạn tìm kiếm không tồn tại</strong>
                        <span>Quay về <a href="<?php echo e(route('index')); ?>"> Trang chủ </a></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make($templatePath . '.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\web\onehealth.foundation\resources\views/errors/404.blade.php ENDPATH**/ ?>