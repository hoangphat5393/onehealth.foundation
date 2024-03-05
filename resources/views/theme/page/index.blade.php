@php extract($data); @endphp

@extends($templatePath . '.layouts.index')

@section('seo')
@endsection

@section('content')
    <main id="page-content">

        <!-- Page Header Start -->
        <div class="container-fluid page-header page-about wow fadeIn px-0" data-wow-delay="0.1s">
            <img class="w-100 banner-max-height object-fit-cover" src="assets/images/page-recruit.jpg" alt="about">
            <div class="container text-center breadcrumb-wrap">
                <h6 class="animated slideInDown">{{ $page->title }}</h1>
                    <nav aria-label="breadcrumb animated slideInDown">
                        <ol class="breadcrumb justify-content-center mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">Trang chủ</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span>{{ $page->title }}</span>
                            </li>
                        </ol>
                    </nav>
            </div>
        </div>
        <!-- Page Header End -->

        <div class="container">
            <h1 class="text-center mt-3 d-none">{{ $page->title }}</h1>
            <div class="row justify-content-center py-5">
                <div class="col-10">
                    {!! htmlspecialchars_decode($page->content) !!}
                </div>
            </div>
        </div>
    </main>
@endsection
