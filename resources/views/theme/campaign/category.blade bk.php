@extends('theme.layouts.index2')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@section('body-class', 'blog')

@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
@endphp

@section('content')

    <header class="header-screen-reader-text d-none">
        <h1 class="page-title">{{ $category->name }}</h1>
    </header>
    <div id="content" class="site-content">
        <div class="container standard-layout">
            <div id="primary" class="content-area has-sidebar active-sidebar">
                <main id="main" class="site-main">
                    @isset($news)
                        @foreach ($news as $item)
                            @php
                                $cdt = new Carbon($item->created_at);
                            @endphp
                            <article id="" class="mb-4 post-standard post-301 post type-post status-publish format-standard has-post-thumbnail hentry category-events category-learn tag-events tag-how-to tag-latte-art tag-learn tag-milk">
                                <header class="entry-header">
                                    <div class="categories">
                                        @if ($item->categories()->exists())
                                            @foreach ($item->categories as $item2)
                                                <a href="{{ route('news.category', $item->slug) }}" rel="category tag">{{ $item2->name }}</a>
                                            @endforeach
                                        @endif
                                    </div>
                                    <h2 class="entry-title">
                                        <a href="{{ route('news.detail', [$item->slug, $item->id]) }}" rel="bookmark">{{ $item->name }}</a>
                                    </h2>
                                    <div class="tnail-meta-wrap has-archive-meta">
                                        <div class="tnail">
                                            <div class="tnail-zoom-wrap">
                                                <a href="{{ route('news.detail', [$item->slug, $item->id]) }}">
                                                    <img width="1200" height="1200" src="{{ get_image($item->image) }}" class="attachment-amaya-uncropped-full size-amaya-uncropped-full wp-post-image" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        {{-- <div class="entry-meta-wrap">
                                            <div class="entry-meta entry-meta-bgcolor has-archive-meta"> <span class="post-info post-info-location"> <i class="fas fa-map-marker-alt"></i> San Francisco </span></div>
                                        </div> --}}
                                    </div>
                                </header>
                                <div class="entry-content">
                                    {!! htmlspecialchars_decode($item->description) !!}
                                </div>

                                <footer class="entry-footer">
                                    <div class="entry-footer-item entry-footer-date">
                                        <div class="post-date pretty-date">
                                            <a href="{{ route('news.category', $item->slug) }}" title="{{ $item->name }}">
                                                <span class="d">{{ $cdt->day }}</span>
                                                <span class="date-right">
                                                    <span class="m">{{ $cdt->getTranslatedMonthName('M') }}</span>
                                                    <span class="y">{{ $cdt->year }}</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="entry-footer-item entry-footer-morebutton">
                                        <a href="{{ route('news.category', $item->slug) }}" class="more-link">
                                            <span class="button button-more button-regular">Chi tiết</span>
                                        </a>
                                    </div>
                                    <div class="entry-footer-item entry-footer-share">
                                        {{-- <div class="post-share">
                                            <div class="share-text">Share</div>
                                            <a target="_blank" rel="nofollow" href="#">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                            <a target="_blank" rel="nofollow" href="#">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                            <a target="_blank" rel="nofollow" href="#">
                                                <i class="fab fa-pinterest"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-envelope"></i>
                                            </a>
                                        </div> --}}
                                    </div>
                                </footer>
                            </article>
                        @endforeach
                    @endisset
                </main>
            </div>


            <aside id="sidebar-archives" class="widget-area right-sidebar center not-sticky use-body-font">
                <div class="theiaStickySidebar">
                    <div class="widgets-wrap">
                        {{-- <section id="featured_post_widget-3" class="widget featured_post_widget">
                            <h2 class="widget-title">Upcoming Event</h2>
                            <ul>
                                <li>
                                    <div class="featured-post">
                                        <div class="tnail-meta-wrap">
                                            <div class="tnail">
                                                <a href="https://www.amayatheme.redsun.design/roastery/professional-latte-art-class/">
                                                    <img src="https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/12/coffeebean-latte-art-4-560x420.jpg" width="560" height="420" alt=""> </a>
                                            </div>

                                            @if ($categories->count() > 0)
                                                <div class="entry-meta-wrap">
                                                    <div class="entry-meta entry-meta-bgcolor">
                                                        <div class="categories">
                                                            @foreach ($categories as $item)
                                                                <a href="https://www.amayatheme.redsun.design/roastery/category/events/" rel="" class="mb-2">{{ $item->name }}</a>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="post-title-small">
                                            <a href="https://www.amayatheme.redsun.design/roastery/professional-latte-art-class/" class="post-title" title="">
                                                Professional Latte Art Class –
                                                Advanced Training
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </section> --}}

                        <section id="featured_post_widget-2" class="widget featured_post_widget">
                            <h2 class="widget-title">Tin mới nhất</h2>
                            <ul>
                                <li>
                                    <div class="featured-post">
                                        <div class="tnail-meta-wrap">
                                            <div class="tnail">
                                                <a href="">
                                                    <img src="https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/12/coffeebean-barrista-560x420.jpg" width="560" height="420" alt="">
                                                </a>
                                            </div>
                                            <div class="entry-meta-wrap">
                                                <div class="entry-meta entry-meta-bgcolor">
                                                    <div class="categories">
                                                        <a href="https://www.amayatheme.redsun.design/roastery/category/interview/" rel="category tag">interview</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post-title-small">
                                            <a href="#" class="post-title" rel="bookmark" title="Permanent Link to Barista Interview: Milo Shaw">
                                                Barista Interview: Milo Shaw</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </section>

                        @if ($categories->count() > 0)
                            <section id="categories_widget-2" class="widget categories_widget">
                                <h2 class="widget-title">Chuyên mục</h2>
                                @foreach ($categories as $item)
                                    <div class="item-product @if (!$loop->last) mb-3 @endif " style="height:120px">
                                        <a href="{{ route('news.category', $item->slug) }}" title="">
                                            <div class="product-img">
                                                <img src="{{ get_image($item->image) }}" class="img-fluid" alt="{{ $item->name }}" style="height:120px">
                                            </div>
                                            <div class="color-overlay">
                                                <div class="overlay-content">{{ $item->name }}</div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </section>
                        @endif

                    </div>
                </div>
            </aside>
        </div>
    </div>

@endsection
