@extends('theme.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@section('content')
    <main id="donate_transfer">
        <section class="block10" style="background:#20a19f;height: 100px;">
            <div class="mainBanner">
                <div class="container main-menu">
                    @include('theme.includes.menu')
                </div>
                {{-- <div class="container-fluid px-0">
                    <div class="row g-0">
                        <div class="col-lg-12 banner-left">
                            <img class="img-fluid object-fit-cover w-100" src="{{ get_image($page->image) }}" alt="{{ $page->name }}">
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>

        <section class="block16">
            <div class="content">
                {!! htmlspecialchars_decode($page->content) !!}
            </div>
            {{-- <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="text-main text-uppercase fw-bold fs-2 mb-4">Thông tin chuyển khoảng</h2>
                        <div class="transfer_info p-3">
                            <p>Tên tài khoản: <strong>HỘI ĐỒNG QUẢN LÝ QUỸ TỪ THIỆN SỨC KHỎE LÀ SỐ 1</strong></p>
                            <p>Số tài khoản: <strong>2011196999999 (VND & USD)</strong></p>
                            <p>Tên ngân hàng: <strong>NGÂN HÀNG TMCP QUÂN ĐỘI - CHI NHÁNH BẮC SÀI GÒN</strong></p>
                            <p>Swift code: <strong>MSCBVNVX</strong></p>
                        </div>
                    </div>
                </div>
            </div> --}}
        </section>

        {{-- Subscribe --}}
        @include('theme.includes.subscribe')
    </main>
@endsection
