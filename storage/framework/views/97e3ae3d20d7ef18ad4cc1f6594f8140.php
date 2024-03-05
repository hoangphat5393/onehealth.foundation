<?php $__env->startSection('seo'); ?>
    <?php echo $__env->make($templatePath . '.layouts.seo', $seo ?? [], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body-class', 'blog'); ?>

<?php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
?>

<?php $__env->startSection('content'); ?>
    <main id="news">
        <h1 class="d-none"><?php echo e($category->name); ?></h1>
        <section class="block1">
            <?php echo $__env->make('theme.includes.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </section>

        
        <section class="block7">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 subscribe-block">
                        <?php echo $__env->make('theme.includes.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div id="content" class="site-content">
        <div class="container standard-layout">
            <div id="primary" class="content-area has-sidebar active-sidebar">
                <main id="main" class="site-main">
                    <?php if(isset($news)): ?>
                        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $cdt = new Carbon($item->created_at);
                                // {{ $cdt->getTranslatedMonthName('M') }}
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </main>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme.layouts.index2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\web\onehealth.foundation\resources\views/theme/news/index.blade.php ENDPATH**/ ?>