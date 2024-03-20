@php
    $partner = \App\Models\Slider::where('status', 0)->where('slider_id', 80)->orderBy('sort', 'asc')->get();
@endphp
<section class="block5">
    <div class="container-fluid">
        <p class="fw-bold fs-4 text-center text-uppercase mb-4">
            @lang('Main partner')
        </p>
        <div class="swiper partnerSlider">
            <div class="swiper-wrapper d-flex align-items-center">
                @foreach ($partner as $item)
                    <div class="swiper-slide">
                        <a href="{{ $item->link ?? '#' }}" target="{{ $item->target ?? '_blank' }}">
                            <img class="img-fluid d-block mx-auto" src="{{ get_image($item->image) }}" alt="{{ $item->name }}">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>


@push('scripts')
    <!-- Initialize Swiper -->
    <script>
        var partnerSlider = new Swiper(".partnerSlider", {
            slidesPerView: 7,
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
            breakpoints: {
                768: {
                    slidesPerView: 3,
                },
                992: {
                    slidesPerView: 5,
                },
                1200: {
                    slidesPerView: 7,
                },
            },
            // pagination: {
            //     el: ".swiper-pagination",
            //     clickable: true,
            // },
        });
    </script>
@endpush
