@extends($templatePath . '.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@php
    // $custom_fields = $page->custom_field ? json_decode($page->custom_field, true) : '';
@endphp

@section('content')
    <main id="about">

        <section class="block10">
            <div class="mainBanner">
                <div class="container main-menu">
                    @include('theme.includes.menu')
                </div>
                <div class="container-fluid px-0">
                    <div class="row g-0">
                        <div class="col-lg-12 banner-left">
                            <img class="img-fluid object-fit-cover w-100" src="{{ get_image($page->image) }}" alt="{{ $page->name }}">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Page content --}}
        <section class="block8">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <h1 class="category-title">{{ $page->title }}</h1>
                        {{-- <div class="my-5">
                            {!! htmlspecialchars_decode($page->description) !!}
                        </div> --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        {!! htmlspecialchars_decode($page->content) !!}
                    </div>
                </div>

                {{-- <div class="row wwa_mission">
                    <div class="col-md-12 pl-3 mt-4 mb-4 text-center">
                        <div class="mission_dot"><span></span></div>
                        <h3>Sứ mệnh</h3>
                        <p></p>
                        <p>OHF thực hiện những dự án nhằm nâng cao các cơ hội được chăm sóc y tế và giáo dục phổ thông tới những người có hoàn cảnh kinh tế khó khăn tại Việt Nam. Đồng thời chúng tôi sẽ tìm ra các giải pháp khắc phục các vấn đề về ô nhiễm môi trường sống cho cộng đồng. Thông qua các dự
                            án chúng tôi tạo điều kiện để thế hệ trẻ Việt Nam phát triển tối đa tiềm năng của họ</p>
                        <p></p>
                    </div>
                </div> --}}


            </div>
        </section>
        {{-- About content End --}}

        <section id="block12">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                    </div>
                </div>
            </div>
        </section>

        {{-- Subscribe --}}
        <section class="block7">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 subscribe-block">
                        @include('theme.includes.subscribe')
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection


@push('scripts')
    {{-- <script>
        var main_splide = new Splide('.main-splide', {
            arrows: false,
            gap: '1.25rem',
            pagination: true,
            arrows: false
        });
        main_splide.mount();
    </script> --}}
@endpush
