@extends('admin.layouts.app')
@php
    if (isset($page_detail)) {
        extract($page_detail->toArray());
        // if ($gallery) {
        //     $gallery = unserialize($gallery);
        // }
    } else {
        $title_head = 'Add new page';
    }

    $title_head = $name ?? '';

    $template = $template ?? '';

    $id = $id ?? 0;

    $date_update = $updated_at ?? date('Y-m-d H:i:s');
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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $title_head }}</h1>
                </div><!-- /.col -->
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
            <form action="{{ route('admin.postPageDetail') }}" method="POST" id="frm-create-page" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? 0 }}">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Post Page</h3>
                            </div> <!-- /.card-header -->
                            <div class="card-body">
                                <!-- show error form -->
                                <div class="errorTxt"></div>
                                <div class="form-group">
                                    <label for="post_slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $slug ?? '' }}">
                                    @if ($id > 0 && $template == 0)
                                        <p><b style="color: #0000cc;">Demo Link:</b> <u><i><a style="color: #F00;" href="<?php echo $link_url_check; ?>" target="_blank"><?php echo $link_url_check; ?></a></i></u></p>
                                    @endif
                                </div>
                                <ul class="nav nav-tabs hidden" id="tabLang" role="tablist">
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
                                            <label for="post_title">Tiêu đề</label>
                                            <input type="text" class="form-control" id="post_title" name="title" placeholder="Tiêu đề" value="{{ $title ?? '' }}">
                                        </div>
                                        @php
                                            $quote_arr = ['id' => 'description', 'label' => 'Trích dẫn', 'name' => 'description', 'description' => $description ?? ''];
                                            $content_arr = ['id' => 'content', 'label' => 'Nội dung 1', 'name' => 'content', 'content' => $content ?? ''];
                                            $content_arr2 = ['id' => 'content2', 'label' => 'Nội dung 2', 'name' => 'content2', 'content' => $content2 ?? ''];
                                            $content_arr3 = ['id' => 'content3', 'label' => 'Nội dung 3', 'name' => 'content3', 'content' => $content3 ?? ''];
                                            $content_arr4 = ['id' => 'content4', 'label' => 'Nội dung 4', 'name' => 'content4', 'content' => $content4 ?? ''];
                                            $content_arr5 = ['id' => 'content5', 'label' => 'Nội dung 5', 'name' => 'content5', 'content' => $content5 ?? ''];
                                        @endphp
                                        @include('admin.partials.quote', $quote_arr)
                                        @include('admin.partials.content', $content_arr)
                                        @include('admin.partials.content', $content_arr2)
                                        @include('admin.partials.content', $content_arr3)
                                        @include('admin.partials.content', $content_arr4)
                                    </div>
                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="form-group">
                                            <label for="title_en">Title</label>
                                            <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Title" value="{{ $title_en ?? '' }}">
                                        </div>
                                        @php
                                            $quote_arr = ['id' => 'description_en', 'label' => 'Description', 'name' => 'description_en', 'description' => $description_en ?? ''];
                                            $content_arr = ['id' => 'content_en', 'label' => 'Content 1', 'name' => 'content_en', 'content' => $content_en ?? ''];
                                            $content_arr2 = ['id' => 'content2_en', 'label' => 'Content 2', 'name' => 'content2_en', 'content' => $content2_en ?? ''];
                                            $content_arr3 = ['id' => 'content3_en', 'label' => 'Content 3', 'name' => 'content3_en', 'content' => $content3_en ?? ''];
                                            $content_arr4 = ['id' => 'content4_en', 'label' => 'Content 4', 'name' => 'content4_en', 'content' => $content4_en ?? ''];
                                            $content_arr5 = ['id' => 'content5_en', 'label' => 'Content 5', 'name' => 'content5_en', 'content' => $content5_en ?? ''];
                                        @endphp
                                        @include('admin.partials.quote', $quote_arr)
                                        @include('admin.partials.content', $content_arr)
                                        @include('admin.partials.content', $content_arr2)
                                        @include('admin.partials.content', $content_arr3)
                                        @include('admin.partials.content', $content_arr4)
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="show_promotion" class="title_txt">Template</label>
                                    <select name="template" class="form-control">
                                        <option value="page" {{ $template == 'page' ? 'selected' : '' }}>Page</option>
                                        <option value="project" {{ $template == 'project' ? 'selected' : '' }}>Dự án</option>
                                    </select>
                                </div>

                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->

                    </div> <!-- /.col-9 -->
                    <div class="col-md-3">
                        @include('admin.partials.action_button')
                        @include('admin.partials.image', ['title' => 'Hình ảnh', 'id' => 'img', 'name' => 'image', 'image' => $image ?? ''])
                        {{-- @include('admin.partials.image', ['title' => 'Hình ảnh Banner', 'id' => 'cover-img', 'name' => 'cover', 'image' => $cover]) --}}
                    </div> <!-- /.col-9 -->
                </div> <!-- /.row -->

                <div class="row">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header">SEO</div>
                            <div class="card-body">
                                {{-- SEO --}}
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
        editorQuote('description');
        editorQuote('description_en');
        editor('content');
        editor('content2');
        editor('content3');
        editor('content4');

        editor('content_en');
        editor('content2_en');
        editor('content3_en');
        editor('content4_en');

        $(function() {
            // $('.slug_slugify').slugify('.title_slugify');
            //xử lý validate
            $("#frm-create-page").validate({
                rules: {
                    post_title: "required",
                },
                messages: {
                    post_title: "Nhập tiêu đề trang",
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
