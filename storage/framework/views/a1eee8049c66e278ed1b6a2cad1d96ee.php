<?php
    $slider_main = \App\Models\Slider::where('status', 0)->where('slider_id', 70)->orderBy('sort', 'asc')->get();
?>

<?php if(empty(!$slider_main)): ?>
    <!-- Slider main container -->
    <div class="swiper mainSlider">

        <div class="container main-menu">
            <?php echo $__env->make('theme.includes.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <?php $__currentLoopData = $slider_main; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                    <img class="w-100 h-100" src="<?php echo e(get_image($item->image)); ?>" alt="<?php echo e($item->name); ?>">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        
        <!-- If we need scrollbar -->
        
    </div>
<?php endif; ?>


<?php $__env->startPush('scripts'); ?>
    <script>
        const mainSlider = new Swiper('.mainSlider', {

            // Optional parameters
            // direction: 'vertical',
            loop: true,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            // navigation: {
            //     nextEl: '.swiper-button-next',
            //     prevEl: '.swiper-button-prev',
            // },

            // And if we need scrollbar
            // scrollbar: {
            //     el: '.swiper-scrollbar',
            // },
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH F:\web\onehealth.foundation\resources\views/theme/includes/slider.blade.php ENDPATH**/ ?>