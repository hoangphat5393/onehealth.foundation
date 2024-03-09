@php extract($data); @endphp

@extends($templatePath . '.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

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
                            {{-- <img class="img-fluid object-fit-cover w-100" src="{{ get_image($page->image) }}" alt="{{ $page->name }}"> --}}
                            <img class="img-fluid object-fit-cover w-100" src="{{ asset('image/map_google.jpg') }}" alt="{{ $page->name }}">
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
            </div>
            {!! htmlspecialchars_decode($page->content) !!}
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
        @include('theme.includes.subscribe')

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
