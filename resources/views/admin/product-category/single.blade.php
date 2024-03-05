@extends('admin.layouts.app')

@php
    $title = 'Thể loại sản phẩm';
    if (isset($category)) {
        extract($category->toArray());
    }
    $id = $id ?? 0;
    $recommended = $recommended ?? 0;
    $hot = $hot ?? 0;
    $date_update = $updated_at ?? date('Y-m-d H:i:s');
@endphp

@section('seo')
    @php
        $data_seo = [
            'title' => $title . ' | ' . setting_option('seo-title-add'),
        ];
        $seo = WebService::getSEO($data_seo);
    @endphp
    @include('admin.partials.seo')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-end">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.productCategoryPost') }}" method="POST" id="frm-create-category" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? 0 }}">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ $title }}</h5>
                            </div> <!-- /.card-header -->
                            <div class="card-body">
                                <!-- show error form -->
                                <div class="errorTxt"></div>
                                {{-- <ul class="nav nav-tabs hidden" id="tabLang" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="vi-tab" data-toggle="tab" href="#vi" role="tab" aria-controls="vi" aria-selected="true">Tiếng việt</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">Tiếng Anh</a>
                                    </li>
                                </ul> --}}
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control slug_slugify" id="slug" name="slug" placeholder="Slug" value="{{ $slug ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Tên chuyên mục</label>
                                            <input type="text" class="form-control title_slugify" id="name" name="name" placeholder="Tiêu đề" value="{{ $name ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Trích dẫn</label>
                                            <textarea id="description" name="description">{!! $description ?? '' !!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Nội dung</label>
                                            <textarea id="content" name="content">{!! $content ?? '' !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="form-group">
                                            <label for="name_en">Title category</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Title" value="{{ $name_en ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description_en">Description category</label>
                                            <textarea id="description_en" name="description_en">{!! $description_en ?? '' !!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="content_en">Content</label>
                                            <textarea id="content_en" name="content_en">{!! $content_en ?? '' !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h5>Thông tin</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="parent" class="col-form-label">Chọn thể loại Cha</label>
                                    @include('admin.product-category.includes.select-category', ['parent' => $parent ?? 0])
                                </div>

                                <div class="form-group">
                                    <label for="sort" class="col-form-label">Sắp xếp</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="{{ $sort ?? 0 }}">
                                </div>

                                {{-- <div class="form-group row">
                                    <label for="recommended" class="col-md-3 text-lg-right col-form-label">Đề xuất</label>
                                    <div class="col-md-9">
                                        <input id="recommended" class="" type="checkbox" value="1" name="recommended" @if ($recommended == 1) checked @endif data-toggle="toggle">
                                    </div>
                                </div> --}}

                                {{-- <div class="form-group row">
                                    <label for="hot" class="col-md-3 text-lg-right col-form-label">Hot</label>
                                    <div class="col-md-9">
                                        <input id="hot" class="" type="checkbox" value="1" name="hot" @if ($hot == 1) checked @endif data-toggle="toggle">
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div> <!-- /.col-9 -->

                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12 order-last order-md-first">
                                @include('admin.partials.action_button')
                            </div>
                            <div class="col-md-12">
                                @include('admin.partials.image', ['title' => 'Icon ', 'id' => 'icon-img', 'name' => 'icon', 'image' => $icon ?? ''])
                            </div>
                        </div>
                        @include('admin.partials.image', ['title' => 'Hình ảnh', 'id' => 'img', 'name' => 'image', 'image' => $image ?? ''])
                        {{-- @include('admin.partials.image', ['title' => 'Hình ảnh Cover', 'id' => 'cover-img', 'name' => 'cover', 'image' => $cover ?? '']) --}}
                    </div> <!-- /.col-9 -->
                </div> <!-- /.row -->

                {{-- SEO --}}
                <div class="row">
                    <div class="col-12 col-md-9">
                        @include('admin.form-seo.seo')
                    </div>
                </div>
                {{-- END SEO --}}

            </form>
        </div> <!-- /.container-fluid -->
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {

            editorQuote('description');
            editorQuote('description_en');

            editor('content');
            editor('content_en');

            //Date range picker
            // $('#reservationdate').datetimepicker({
            //     format: 'YYYY-MM-DD hh:mm:ss'
            // });

            //xử lý validate
            $("#frm-create-category").validate({
                rules: {
                    name: "required",
                },
                messages: {
                    name: "Nhập tiêu đề thể loại tin",
                },
                errorElement: 'div',
                errorLabelContainer: '.errorTxt',
                invalidHandler: function(event, validator) {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
                }
            });
        });
    </script>
@endpush
