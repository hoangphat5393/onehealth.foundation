<?php
    $partner = \App\Models\Slider::where('status', 0)->where('slider_id', 83)->orderBy('sort', 'asc')->get();
?>

<div class="swiper partnerSlider">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img class="img-fluid mx-auto" src="https://onehealth.foundation/wp-content/uploads/2018/08/logo4.png" alt="">
        </div>
        <div class="swiper-slide">
            <img class="img-fluid mx-auto" src="https://onehealth.foundation/wp-content/uploads/2018/08/logo7.png" alt="">
        </div>
        <div class="swiper-slide">
            <img class="img-fluid mx-auto" src="https://onehealth.foundation/wp-content/uploads/2018/08/logo7.png" alt="">
        </div>
        <div class="swiper-slide">
            <img class="img-fluid mx-auto" src="https://onehealth.foundation/wp-content/uploads/2018/08/logo6.png" alt="">
        </div>
        <div class="swiper-slide">
            <img class="img-fluid mx-auto" src="https://onehealth.foundation/wp-content/uploads/2018/08/logo9.png" alt="">
        </div>
        <div class="swiper-slide">
            <img class="img-fluid mx-auto" src="https://onehealth.foundation/wp-content/uploads/2018/08/logo10.jpg" alt="">
        </div>
        <div class="swiper-slide">
            <img class="img-fluid mx-auto" src="https://onehealth.foundation/wp-content/uploads/2018/08/logo10.jpg" alt="">
        </div>
        <div class="swiper-slide">
            <img class="img-fluid mx-auto" src="https://onehealth.foundation/wp-content/uploads/2018/08/logo10.jpg" alt="">
        </div>
        <div class="swiper-slide">
            <img class="img-fluid mx-auto" src="https://onehealth.foundation/wp-content/uploads/2018/08/logo10.jpg" alt="">
        </div>
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
            speed: 11000,
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