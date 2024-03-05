@extends('theme.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

{{-- @section('body-class', 'single') --}}

@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
@endphp

{{-- @push('head-style')
    <link rel="stylesheet" href="https://onehealth.foundation/wp-includes/css/dist/block-library/style.min.css?ver=5.6">
@endpush --}}

@section('content')
    <main id="news_category">
        <section class="block10">

            <div class="mainBanner">
                <div class="container main-menu">
                    @include('theme.includes.menu')
                </div>

                <div class="container-fluid px-0">
                    <div class="row g-0">

                        <div class="col-lg-6 banner-left">
                            <img class="img-fluid object-fit-cover h-100" src="{{ get_image($news->image) }}" alt="">
                        </div>
                        <div class="col-lg-6 banner-right d-flex align-items-center">
                            <div class="w-100">
                                <div class="wrapper">
                                    <div class="mosaic-lede-banner__headline">
                                        <h1 class="mosaic-lede-banner__headline-subtitle">{{ $news->name }}</h1>
                                    </div>
                                    {{-- <div class="markdown with-lists mosaic-lede-banner__blurb"></div>
                                    <div class="mosaic-lede-banner__signup">
                                        <p class="invite_to_join"></p>
                                        <div class="message-callout -below -white -mosaic-arrow d-none">
                                            <div class="message-callout__copy">
                                                <p>Win a $3,000 Scholarship</p>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>

                                <div class="promotions mosaic-lede-banner__sponsor padding-top-lg clear-both">
                                    <div class="promotion promotion--sponsor">
                                        <div class="d-flex wrapper align-items-center">
                                            <p class="__copy">Powered by</p>
                                            <div class="__image"><img src="https://onehealth.foundation/wp-content/themes/thewish/img/logo/logo_Droh_70x70.png" alt="DrOh.co"></div>
                                            <div class="__image "><img src="https://onehealth.foundation/wp-content/themes/thewish/img/logo/logo_onehealth_70x70.png" alt="OneHealth"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-5">
            <div class="container">
                @empty(!$news)
                    <div class="content-news">
                        {!! htmlspecialchars_decode($news->content) !!}
                    </div>
                @endempty
            </div>
        </section>

        <section class="block11 my-5">
            <div class="container-fluid bg-light-dark py-5">
                <div class="row">
                    <div class="col-lg-12 text-center text-white">
                        <p>Mỗi chiến dịch thiện nguyện của OneHealth Foundation với hơn 2 triệu người tham gia. Luôn sẵn sàng với tất cả tình huống, thời gian, địa điểm.</p>
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
        (function() {
            window.mc4wp = window.mc4wp || {
                listeners: [],
                forms: {
                    on: function(evt, cb) {
                        window.mc4wp.listeners.push({
                            event: evt,
                            callback: cb
                        });
                    }
                }
            }
        })();
    </script> --}}
@endpush
