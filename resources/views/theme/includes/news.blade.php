@inject('Post', 'App\Models\Post')
@php
    $posts = $Post::where('status', 1)->orderbyDesc('sort')->get();
@endphp
<div class="news-wrap py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-3 mb-5 mb-md-0">
                <div class="section-title">
                    <p class="text-uppercase">Hóa keo Bình Thạnh</p>
                    <h6 class="text-uppercase">Tin mới nhất</h6>
                </div>
                <div class="animation-line">
                    <div class="line"></div>
                </div>
                <div class="content-news">
                    <p></p>
                </div>
                <div class="news-control mt-2">
                    <div class="swiper-button-next next-news">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                    <div class="swiper-button-prev prev-news">
                        <i class="bi bi-chevron-left"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-lg-9 mt-4 mt-md-0">
                @if ($posts->count() > 0)
                    <div class="news-slider swiper">
                        <div class="swiper-wrapper">
                            @foreach ($posts as $item)
                                <div class="item-news swiper-slide">
                                    <a href="{{ route('news.detail', [$item->slug, $item->id]) }}" target="_blank" title="{{ $item->name }}">
                                        <div class="news-thumb">
                                            <img src="{{ get_image($item->image) }}" />
                                        </div>
                                        <div class="news-content">
                                            <div class="news-meta flex-column flex-lg-row d-lg-flex align-items-center">
                                                <div class="cate-tag">Tin chuyên ngành</div>
                                                <div class="news-date">
                                                    <span class="time">{{ date('H:s', strtotime($item->created_at)) }}</span>
                                                    |
                                                    <span class="date">{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                                </div>
                                            </div>
                                            <div class="news-blog">
                                                <p>{{ $item->name }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // News swiper
        var swiper = new Swiper(".news-slider", {
            loop: true,
            spaceBetween: 20,
            // autoplay: {
            //     delay: 2500,
            //     disableOnInteraction: false,
            // },
            navigation: {
                nextEl: ".next-news",
                prevEl: ".prev-news",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>
@endpush
