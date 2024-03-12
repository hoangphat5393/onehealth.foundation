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
                        <div class="col-lg-12">
                            <img class="img-fluid object-fit-cover w-100" src="{{ get_image($campaign->image) }}" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="mt-5">
            <div class="container">
                @empty(!$campaign)
                    <div class="render-content">
                        {!! htmlspecialchars_decode($campaign->content) !!}
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
        @include('theme.includes.subscribe')
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
