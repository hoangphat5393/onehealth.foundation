@extends('theme.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@section('content')
    <main id="donate_transfer">
        <section class="block16">
            <div class="content">
                {!! htmlspecialchars_decode($page->content) !!}
            </div>
        </section>

        {{-- Subscribe --}}
        @include('theme.includes.subscribe')
    </main>
@endsection
