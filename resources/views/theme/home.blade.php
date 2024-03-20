@php
    // $category_product = Menu::getByName('Categories-product-home');
    $lc = app()->getLocale();
@endphp

@extends($templatePath . '.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@section('content')
    <main id="main">

        {{-- <section class="block1">
            @include('theme.includes.hero_section')
        </section> --}}

        {{-- @include('theme.includes.counter') --}}



        <section class="block2">
            {!! htmlspecialchars_decode($page->content) !!}
        </section>



        {{-- Dự án (Campaign) --}}
        @php
            $project = \App\Campaign::where('status', 1)->limit(3)->get();
        @endphp
        <section class="block3">
            <div class="container pt-5">
                <div class="row">
                    <div class="col-lg-4">
                        <h3 class="upper">@lang('Our Projects')</h3>
                        {!! htmlspecialchars_decode(setting_option('our_project_' . $lc)) !!}
                        <a href="{{ route('page', 'du-an') }}" class="btn btn-custom my-3">@lang('See all projects') <i class="fa-solid fa-angles-right"></i></a>
                        <form method="get" action="{{ route('search') }}">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="keyword" placeholder="@lang('Search')" aria-label="@lang('Search')" aria-describedby="button-addon2">
                                <button class="btn btn-search" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>

                    @empty(!$project)
                        <div class="col-lg-8">
                            @foreach ($project as $item)
                                <div class="row project mb-4 g-0">

                                    <div class="col-lg-6 align-items-stretch project__content order-2">
                                        <div class="content p-3 bg-white">
                                            <h4><a href="{{ route('campaign.detail', [$item->slug, $item->id]) }}" class="text-main">{{ $item->name }}</a></h4>
                                            <div>
                                                {!! htmlspecialchars_decode($item->description) !!}
                                            </div>
                                        </div>
                                        <a href="{{ route('page', 'donate') }}" class="project-link bg-white fit-content float-end text-main fw-bold px-2">
                                            <span class="text-uppercase">@lang('Donate now')</span>&nbsp;
                                            <i class="fa fa-chevron-down"></i>
                                        </a>
                                    </div>
                                    <div class="col-lg-6 order-lg-2">
                                        <div class="item-product">
                                            <a href="#" title="">
                                                <div class="product-img">
                                                    <img class="w-100" src="{{ get_image($item->image) }}" alt="">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endempty
                </div>
            </div>
        </section>

        {{-- Hoạt động (News) --}}
        @php
            $news = \App\News::where('status', 1)->orderByDesc('sort')->limit(3)->get();
        @endphp
        <section class="block4">
            <div class="container pt-5">
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <p class="fw-bold fs-4 text-uppercase">@lang('activity')</p>
                            <a href="{{ route('news') }}" class="btn btn-custom"> @lang('View all')</a>
                        </div>
                    </div>
                </div>

                @empty(!$news)
                    <div class="row">
                        @foreach ($news as $item)
                            <div class="col-lg-4">
                                <div class="item-product mb-2">
                                    <a href="{{ route('news.detail', [$item->slug, $item->id]) }}" title="{{ $item->name }}">
                                        <div class="product-img">
                                            <img src="{{ get_image($item->image) }}" class="" alt="{{ $item->name }}">
                                        </div>
                                    </a>
                                </div>
                                <h5 class="title desc-truncate">
                                    <a href="{{ route('news.detail', [$item->slug, $item->id]) }}">{{ $item->name }}</a>
                                </h5>
                            </div>
                        @endforeach
                    </div>
                @endempty
            </div>
        </section>

        {{-- Partner --}}
        @include('theme.includes.partner')

        <section class="block6">
            {!! htmlspecialchars_decode(setting_option('bottom_text_' . App::getLocale())) !!}
            {{-- <div class="container testimonial">
                <div class="row py-3">
                    <div class="col-lg-8 p-5">
                        <p class="mb-3">“Tôi đã tìm thấy chính mình tại nơi đây. Cảm ơn Quỹ từ thiện sức khỏe là số 1 đã cho tôi cơ hội để tôi có thể cống hiến hết sức mình vì cộng đồng”</p>
                        <span class="d-block text-end">Bà Vương Thu Nguyệt - Giám đốc điều hành</span>
                    </div>
                    <div class="col-lg-4">
                        <img class="img-fluid d-block mx-auto" src="{{ asset('images/vtn.png') }}">
                    </div>
                </div>
            </div> --}}
        </section>

        {{-- Subscribe --}}
        @include('theme.includes.subscribe')





    </main>
@endsection

@push('scripts')
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const el = document.querySelector('.counter');
        //     // Tiếp tục xử lý tại đây...
        // });
    </script>
@endpush
