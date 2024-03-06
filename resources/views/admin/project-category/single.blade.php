@extends('admin.layouts.app')
@php
    extract($data);
    if (isset($category)) {
        extract($category->toArray());
    }
    $date_update = $updated_at ?? date('Y-m-d H:i:s');
    $recommended = $recommended ?? 0;
    $hot = $hot ?? 0;
    $id = $id ?? 0;
@endphp
@section('seo')
    @php
        $data_seo = [
            'title' => $title_head . ' | ' . Helpers::get_option_minhnn('seo-title-add'),
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
                        <li class="breadcrumb-item active">{{ $title_head }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.projectCategoryPost') }}" method="POST" id="frm-create-category" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? '' }}">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title_head }}</h3>
                            </div> <!-- /.card-header -->
                            <div class="card-body">
                                <!-- show error form -->
                                <div class="errorTxt"></div>
                                <ul class="nav nav-tabs d-none" id="tabLang" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="vi-tab" data-toggle="tab" href="#vi" role="tab" aria-controls="vi" aria-selected="true">Tiếng việt</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">Tiếng Anh</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control slug_slugify" id="slug" name="slug" placeholder="Slug" value="{{ $slug ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Tiêu đề thể loại tin</label>
                                            <input type="text" class="form-control title_slugify" id="name" name="name" placeholder="Tiêu đề" value="{{ $name ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Trích dẫn</label>
                                            <textarea id="description" name="description">{!! $description ?? '' !!}</textarea>
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
                                    </div>
                                </div>

                                {{-- <div class="form-group">
                                    <label for="template_checkID" class="title_txt">Chọn thể loại Cha</label>
                                    @include('admin.post-category.includes.select-category', ['parent' => $parent ?? 0])
                                </div> --}}

                                {{-- <div class="form-group row">
                                    <label for="recommended" class="col-md-3 text-lg-right col-form-label">Đề xuất</label>
                                    <div class="col-md-9">
                                        <input id="recommended" class="" type="checkbox" value="1" name="recommended" @if ($recommended == 1) checked @endif data-toggle="toggle">
                                    </div>
                                </div> --}}

                                {{-- <div class="clear action_group_box_touth">
                                    <label style="color: #FF7E00;" class="title_action_lb">Hot</label>
                                    <input id="toggle-propose-{{ $id }}" data-width="100" data-toggle="toggle" onchange="story_quick_update_option({{ $id }}, 'hot')" type="checkbox" value="1" name="hot" @if ($hot == 1) checked @endif>
                                </div> --}}

                                <div class="form-group">
                                    <label for="parent" class="col-form-label">Chuyên mục phụ thuộc</label>
                                    @include('admin.project-category.includes.select-category', ['parent' => $parent ?? 0])
                                </div>

                                {{-- <div class="form-group">
                                    <label class="col-form-label mr-3 text-warning" style="color: #FF7E00;">Nổi bật</label>
                                    <input type="checkbox" id="hot" class="form-control" data-width="100" data-toggle="toggle" value="1" name="hot" @if ($hot == 1) checked @endif>
                                </div> --}}

                                <div class="form-group">
                                    <label for="col-form-label">Số thứ tự</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="{{ $sort ?? 0 }}">
                                </div>

                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->
                    </div> <!-- /.col-md-9 -->

                    <div class="col-md-3">
                        @include('admin.partials.action_button')
                        @include('admin.partials.image', ['title' => 'Hình ảnh', 'id' => 'img', 'name' => 'image', 'image' => $image ?? ''])
                        {{-- @include('admin.partials.image', ['title' => 'Banner', 'id' => 'cover-img', 'name' => 'cover', 'image' => $cover ?? '']) --}}
                    </div> <!-- /.col-md-9 -->
                </div> <!-- /.row -->

                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">SEO</div>
                            <div class="card-body">
                                <!--SEO-->
                                @include('admin.form-seo.seo')
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div> <!-- /.container-fluid -->
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {

            editorQuote('description');
            editorQuote('description_en');

            $('#thumbnail_file').change(function(evt) {
                $("#thumbnail_file_link").val($(this).val());
                $("#thumbnail_file_link").attr("value", $(this).val());
            });

            //xử lý validate
            $("#frm-create-category").validate({
                rules: {
                    post_title: "required",
                },
                messages: {
                    post_title: "Nhập tiêu đề thể loại tin",
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
