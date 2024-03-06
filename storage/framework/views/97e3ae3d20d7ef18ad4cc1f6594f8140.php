

<?php $__env->startSection('seo'); ?>
    <?php echo $__env->make($templatePath . '.layouts.seo', $seo ?? [], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body-class', 'blog'); ?>

<?php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
?>

<?php $__env->startSection('content'); ?>

    <main id="news_category">
        <section class="block1">
            <?php echo $__env->make('theme.includes.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </section>

        <section class="block8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="category-title"><?php echo app('translator')->get('News'); ?></h1>
                        
                    </div>
                </div>

                <?php if(isset($news)): ?>
                    <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $cdt = new Carbon($item->created_at);
                        ?>

                        <div class="row article g-0 mb-5">
                            <div class="col-lg-4 article__img">
                                <div class="item-product">
                                    <a href="#" title="">
                                        <div class="product-img">
                                            <img src="<?php echo e(get_image($item->image)); ?>" class="img-fluid" alt="<?php echo e($item->name); ?>">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-8 article__desc">
                                <div class="datetime text-end my-3">
                                    <span><?php echo e($cdt->format('d-m-Y')); ?></span>
                                </div>
                                <h4><a href="<?php echo e(route('news.detail', [$item->slug, $item->id])); ?>" class="custom"><?php echo e($item->name); ?></a></h4>
                                <?php echo htmlspecialchars_decode($item->description); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="nav-pagination">
                        <?php echo e($news->links($templateFile . '.pagination.custom')); ?>

                        
                    </div>
                <?php endif; ?>

            </div>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\web\onehealth.foundation\resources\views/theme/news/index.blade.php ENDPATH**/ ?>