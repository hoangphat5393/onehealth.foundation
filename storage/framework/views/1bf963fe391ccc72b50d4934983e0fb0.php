<?php
    $partner = \App\Models\Slider::where('status', 0)->where('slider_id', 80)->orderBy('sort', 'asc')->get();
?>

<div class="swiper partnerSlider">
    <div class="swiper-wrapper">
        <?php $__currentLoopData = $partner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <a href="https://www.google.com/">
                    <img class="img-fluid mx-auto" src="<?php echo e(get_image($item->image)); ?>" alt="<?php echo e($item->name); ?>">
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="swiper-pagination"></div>
</div>


<?php $__env->startPush('scripts'); ?>
    <!-- Initialize Swiper -->
    <script>
        var partnerSlider = new Swiper(".partnerSlider", {
            slidesPerView: 6,
            spaceBetween: 30,
            grabCursor: true,
            a11y: false,
            freeMode: true,
            speed: 10000,
            loop: true,
            autoplay: {
                delay: 0.5,
                disableOnInteraction: false,
            },
            // pagination: {
            //     el: ".swiper-pagination",
            //     clickable: true,
            // },
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH F:\web\onehealth.foundation\resources\views/theme/includes/partner.blade.php ENDPATH**/ ?>