<?php extract($data); ?>



<?php $__env->startSection('seo'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main id="page-content">

        <!-- Page Header Start -->
        <div class="container-fluid page-header page-about wow fadeIn px-0" data-wow-delay="0.1s">
            <img class="w-100 banner-max-height object-fit-cover" src="assets/images/page-recruit.jpg" alt="about">
            <div class="container text-center breadcrumb-wrap">
                <h6 class="animated slideInDown"><?php echo e($page->title); ?></h1>
                    <nav aria-label="breadcrumb animated slideInDown">
                        <ol class="breadcrumb justify-content-center mb-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('index')); ?>">Trang chủ</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span><?php echo e($page->title); ?></span>
                            </li>
                        </ol>
                    </nav>
            </div>
        </div>
        <!-- Page Header End -->

        <div class="container">
            <h1 class="text-center mt-3 d-none"><?php echo e($page->title); ?></h1>
            <div class="row justify-content-center py-5">
                <div class="col-10">
                    <?php echo htmlspecialchars_decode($page->content); ?>

                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($templatePath . '.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\web\onehealth.foundation\resources\views/theme/page/index.blade.php ENDPATH**/ ?>