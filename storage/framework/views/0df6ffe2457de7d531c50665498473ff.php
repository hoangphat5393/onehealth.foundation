

<?php $__env->startSection('seo'); ?>
    <?php echo $__env->make($templatePath . '.layouts.seo', $seo ?? [], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>



<?php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
?>



<?php $__env->startSection('content'); ?>
    <main id="news_category">
        <section class="block10">

            <div class="mainBanner">
                <div class="container main-menu">
                    <?php echo $__env->make('theme.includes.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <div class="container-fluid px-0">
                    <div class="row g-0">
                        <div class="col-lg-6 banner-left">
                            <img class="img-fluid object-fit-cover h-100" src="<?php echo e(get_image($news->image)); ?>" alt="">
                        </div>
                        <div class="col-lg-6 banner-right d-flex align-items-center">
                            <div class="w-100">
                                <div class="wrapper">
                                    <div class="mosaic-lede-banner__headline">
                                        <h1 class="mosaic-lede-banner__headline-subtitle"><?php echo e($news->name); ?></h1>
                                    </div>
                                </div>

                                <div class="promotions mosaic-lede-banner__sponsor padding-top-lg clear-both">
                                    <div class="promotion promotion--sponsor">
                                        <div class="d-flex wrapper align-items-center">
                                            <p class="__copy">Powered by</p>
                                            <div class="__image">
                                                <img src="https://onehealth.foundation/wp-content/themes/thewish/img/logo/logo_Droh_70x70.png" alt="DrOh.co">
                                            </div>
                                            <div class="__image ">
                                                <img src="https://onehealth.foundation/wp-content/themes/thewish/img/logo/logo_onehealth_70x70.png" alt="OneHealth">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-5">
            <div class="container">
                <?php if(empty(!$news)): ?>
                    <div class="render-content">
                        <?php echo htmlspecialchars_decode($news->content); ?>

                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="block11 my-5">
            <div class="container-fluid bg-light-dark py-5">
                <div class="row">
                    <div class="col-lg-12 text-center text-white">
                        <p>Mỗi chiến dịch thiện nguyện của OneHealth Foundation với hơn 2 triệu người tham gia. Luôn sẵn sàng với tất cả tình huống, thời gian, địa điểm.</p>
                    </div>
                </div>
            </div>
        </section>

        
        <?php echo $__env->make('theme.includes.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make('theme.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\web\onehealth.foundation\resources\views/theme/news/single.blade.php ENDPATH**/ ?>