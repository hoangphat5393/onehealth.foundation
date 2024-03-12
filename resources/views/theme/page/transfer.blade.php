@extends('theme.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

{{-- @section('body-class', 'page-template-default page page-id-1940') --}}

@section('content')
    <main id="donate_transfer">
        <section class="block15">
            <div class="container-fluid my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <p class="fs-2 text-main text-uppercase fw-bold mb-3">Thông tin chuyển khoảng</p>
                        <p>Tên tài khoản: HỘI ĐỒNG QUẢN LÝ QUỸ TỪ THIỆN SỨC KHỎE LÀ SỐ 1</p>
                        <p>Số tài khoản: 2011196999999 (VND & USD)</p>
                        <p>Tên ngân hàng: NGÂN HÀNG TMCP QUÂN ĐỘI - CHI NHÁNH BẮC SÀI GÒN</p>
                        <p>Swift code: MSCBVNVX</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Subscribe --}}
        @include('theme.includes.subscribe')
    </main>
@endsection
