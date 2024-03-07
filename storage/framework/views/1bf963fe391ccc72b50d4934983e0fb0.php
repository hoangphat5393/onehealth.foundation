<?php
    $partner = \App\Models\Slider::where('status', 0)->where('slider_id', 80)->orderBy('sort', 'asc')->get();
?>
<section class="block5">
    <div class="container">
        <p class="fw-bold fs-4 mb-4">ĐỐI TÁC CHÍNH</p>
        <div class="swiper partnerSlider">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $partner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                        <a href="<?php echo e($item->link); ?>" target="<?php echo e($item->target); ?>">
                            <img class="img-fluid mx-auto" src="<?php echo e(get_image($item->image)); ?>" alt="<?php echo e($item->name); ?>">
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>


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