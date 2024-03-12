@extends('theme.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@section('content')
    <main id="donate_transfer">
        <section class="block16">
            <div class="container-fluid my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="fs-2 text-main text-uppercase fw-bold mb-3">Thông tin chuyển khoảng</h2>
                        <div class="bg-body-secondary p-3">
                            <p>Tên tài khoản: <strong>HỘI ĐỒNG QUẢN LÝ QUỸ TỪ THIỆN SỨC KHỎE LÀ SỐ 1</strong></p>
                            <p>Số tài khoản: <strong>2011196999999 (VND & USD)</strong></p>
                            <p>Tên ngân hàng: <strong>NGÂN HÀNG TMCP QUÂN ĐỘI - CHI NHÁNH BẮC SÀI GÒN</strong></p>
                            <p>Swift code: <strong>MSCBVNVX</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Subscribe --}}
        @include('theme.includes.subscribe')
    </main>
@endsection
