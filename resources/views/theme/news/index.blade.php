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
    <main id="news">

        <h1 class="d-none">{{ $category->name }}</h1>
        <section class="block1">
            @include('theme.includes.slider')
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

    <div id="content" class="site-content">
        <div class="container standard-layout">
            <div id="primary" class="content-area has-sidebar active-sidebar">
                <main id="main" class="site-main">
                    @isset($news)
                        @foreach ($news as $item)
                            @php
                                $cdt = new Carbon($item->created_at);
                                // {{ $cdt->getTranslatedMonthName('M') }}
                            @endphp
                        @endforeach
                    @endisset
                </main>
            </div>

        </div>
    </div>

@endsection
