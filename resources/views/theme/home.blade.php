@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
    $lc = app()->getLocale();

    // $category_product = Menu::getByName('Categories-product-home');

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
            <div class="container py-5">
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <h3 class="fs-2 fw-bold text-center">@lang('Our Projects')</h3>

                        <div class="my-4">
                            {!! htmlspecialchars_decode(setting_option('our_project_' . $lc)) !!}
                        </div>
                        {{-- <a href="{{ route('page', 'du-an') }}" class="btn btn-custom my-3">@lang('See all projects') <i class="fa-solid fa-angles-right"></i></a> --}}
                        {{-- <form method="get" action="{{ route('search') }}">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="keyword" placeholder="@lang('Search')" aria-label="@lang('Search')" aria-describedby="button-addon2">
                                <button class="btn btn-search" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
                            </div>
                        </form> --}}
                    </div>
                </div>

                <div class="row mb">
                    @empty(!$project)
                        @foreach ($project as $item)
                            <div class="col-lg-4 project">
                                <div class="product-img">
                                    <img class="w-100" src="{{ get_image($item->image) }}" alt="{{ $item->name }}">
                                </div>
                                <div class="content d-flex flex-column">
                                    <h4 class="my-3">
                                        <a href="{{ route('campaign.detail', [$item->slug, $item->id]) }}" class="text-main">{{ $item->name }}</a>
                                    </h4>
                                    <div class="project__description mb-4">
                                        {!! htmlspecialchars_decode($item->description) !!}
                                    </div>
                                    <a class="btn btn-custom w-fit-content" href="{{ route('page', 'donate') }}">
                                        @lang('Project sponsorship')
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endempty
                </div>

                <div class="text-end mt-5">
                    <a href="{{ route('page', 'du-an') }}" class="fs-4 my-3 fw-bold link-custom">@lang('All projects') <i class="fa-solid fa-right-long"></i></a>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="fw-bold fs-4 text-uppercase">@lang('activity')</p>
                            <a href="{{ route('news.category', 'hoat-dong') }}" class="fs-5 my-3 fw-bold link-custom">@lang('View all') <i class="fa-solid fa-right-long"></i></a>
                        </div>
                    </div>
                </div>

                @empty(!$news)
                    <div class="row">
                        @foreach ($news as $item)
                            @php
                                $cdt = new Carbon($item->created_at);
                            @endphp
                            <div class="col-lg-4 item-news">
                                <div class="item-product">
                                    <a href="{{ route('news.detail', [$item->slug, $item->id]) }}" title="{{ $item->name }}">
                                        <div class="product-img">
                                            <img src="{{ get_image($item->image) }}" class="" alt="{{ $item->name }}">
                                        </div>
                                    </a>
                                </div>

                                <a href="{{ route('news.detail', [$item->slug, $item->id]) }}" class="link-custom">
                                    <div class="news-content">
                                        <div class="news-meta mb-2">
                                            <div class="cate-tag">{{ $item->categories->first()->name }}</div>
                                            <div class="news-date">
                                                <i class="fa-solid fa-circle"></i>
                                                <span class="time">{{ $cdt->format('h:i') }}</span> | <span class="date">{{ $cdt->format('d-m-Y') }}</span>
                                            </div>
                                        </div>
                                        <h5 class="title">
                                            {{ $item->name }}
                                        </h5>
                                    </div>
                                </a>
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
