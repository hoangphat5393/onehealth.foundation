@extends($templatePath . '.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@php
    // $custom_fields = $page->custom_field ? json_decode($page->custom_field, true) : '';
@endphp

@section('content')
    <main id="about">

        {{-- Page content --}}
        {!! htmlspecialchars_decode($page->content) !!}
        {{-- Page content End --}}

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
