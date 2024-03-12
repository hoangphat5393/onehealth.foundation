@php
    // $category_product = Menu::getByName('Categories-product-home');
@endphp

@extends($templatePath . '.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@section('content')
    <main id="main">

        <section class="block1">
            @include('theme.includes.hero_section')
        </section>

        <section class="block2">
            <div class="container pt-5 pb-5 d-none d-md-block">
                <div class="row">
                    <div class="col-md-12 mission">
                        <h3>SỨ MỆNH</h3>
                        <p>
                            OHF thực hiện những dự án nhằm nâng cao các cơ hội được chăm sóc y tế và giáo dục phổ thông tới những người có hoàn cảnh kinh tế khó khăn tại Việt Nam. Đồng thời chúng tôi sẽ tìm ra các giải pháp khắc phục các vấn đề về ô nhiễm môi trường sống cho cộng đồng. Thông qua các dự
                            án
                            chúng tôi tạo điều kiện để thế hệ trẻ Việt Nam phát triển tối đa tiềm năng của họ
                        </p>
                    </div>
                    <div class="col-md-12 vission">
                        <h3 class="text-end">TẦM NHÌN</h3>
                        <p>OHF tập trung xây dựng một hệ thống y tế cộng đồng bền vững trên toàn lãnh thổ Việt Nam để đảm bảo cho tất cả người dân đều được chăm sóc về y tế, giáo dục hiệu quả với chi phí phù hợp và sống trong môi trường lành mạnh.</p>
                        <div class="d-block text-end">
                            <a class="btn btn-custom" href="{{ route('page', 'about') }}">Chúng tôi là ai <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container d-block d-md-none" style="background: #999999;">
                <div class="row">
                    <div class="col-md-12 mission">
                        <h3>OUR MISSION</h3>
                        <p></p>
                        <p>
                            One Health Foundation aims to expand public medical care as well as education opportunity to ﬁnancially disadvantage people in Vietnam. We also develop solutions for environmental issues to the local community. We will empower Vietnamese youths to develop themselves to their
                            full potential.
                        </p>
                        <p></p>
                    </div>
                    <div class="col-md-12 vission pb-2" style="">
                        <h3 class="text-right">VISION</h3>
                        <p></p>
                        <p>One Health Foundation funds projects in order to build a nation-wide sustainable public healthcare ecosystem in Vietnam where everyone got eﬀective and aﬀordable medical treatment, education and a clean living environment.</p>
                        <p></p>
                        <a href="https://onehealth.foundation/eg/who-we-are/" class="btn btn-custom">Who We Are</a>
                    </div>
                </div>
            </div>
        </section>

        @include('theme.includes.counter')

        {{-- Dự án (Campaign) --}}
        @php
            $project = \App\Models\Campaign::where('status', 1)->limit(3)->get();
        @endphp
        <section class="block3">
            <div class="container pt-5">
                <div class="row">
                    <div class="col-lg-4">
                        <h3 class="upper">Dự án của chúng tôi</h3>
                        <p class="mb-3">Quỹ từ thiện One Health Foundation (OHF) <br>thực hiện sứ mệnh của chúng tôi thông qua <br>ba dự án chính về y tế, giáo dục và môi trường.</p>
                        <p>OHF tin rằng với đội ngũ thế hệ trẻ Việt Nam ngày nay, các bạn sẽ hết lòng vì cộng đồng để xây dựng đất nước ngày càng phát triển hơn.</p>
                        <a href="{{ route('page', 'du-an') }}" class="btn btn-custom my-3">@lang('See all projects') <i class="fa-solid fa-angles-right"></i></a>

                        <form method="get" action="#">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="button-addon2">
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
            $news = \App\Models\Post::where('status', 1)->orderByDesc('sort')->limit(3)->get();
        @endphp
        <section class="block4">
            <div class="container mt-5 pt-5">
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
            <div class="container testimonial">
                <div class="row py-3">
                    <div class="col-lg-8 p-5">
                        <p class="mb-3">“Tôi đã tìm thấy chính mình tại nơi đây. Cảm ơn Quỹ từ thiện sức khỏe là số 1 đã cho tôi cơ hội để tôi có thể cống hiến hết sức mình vì cộng đồng”</p>
                        <span class="d-block text-end">Bà Vương Thu Nguyệt - Giám đốc điều hành</span>
                    </div>
                    <div class="col-lg-4">
                        <img class="img-fluid" src="{{ asset('images/vtn.png') }}">
                    </div>
                </div>
            </div>
        </section>

        {{-- Subscribe --}}
        @include('theme.includes.subscribe')
    </main>
@endsection
