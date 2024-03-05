@extends('admin.layouts.app')
@php
    if (isset($post)) {
        extract($post->toArray());
        if ($gallery) {
            $gallery = unserialize($gallery);
        }
    } else {
        $title_head = 'Add new post';
    }

    $title_head = $name ?? '';

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
            <form action="{{ route('admin.servicePost') }}" method="POST" id="frm-create-post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? 0 }}">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $title_head }}</h4>
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
                                        {{-- <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control slug_slugify" id="slug" name="slug" placeholder="Slug" value="{{ $slug ?? '' }}">
                                            @if ($id > 0)
                                                <p><b style="color: #0000cc;">Link:</b>
                                                    <u><i><a style="color: #F00;" href="{{ route('news.detail', [$slug, $id]) }}" target="_blank">{{ route('news.detail', [$slug, $id]) }}</a></i></u>
                                                </p>
                                            @endif
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="name">Tên dịch vụ</label>
                                            <input type="text" class="form-control title_slugify" id="name" name="name" placeholder="Tiêu đề" value="{{ $name ?? '' }}">
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="description">Trích dẫn</label>
                                            <textarea id="description" name="description">{!! $description ?? '' !!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Nội dung</label>
                                            <textarea id="content" name="content">{!! $content ?? '' !!}</textarea>
                                        </div> --}}
                                    </div>
                                    {{-- <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="form-group">
                                            <label for="name_en">Title</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Title" value="{{ $name_en ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description_en">Description</label>
                                            <textarea id="description_en" name="description_en">{!! $description_en ?? '' !!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="content_en">Content</label>
                                            <textarea id="content_en" name="content_en">{!! $content_en ?? '' !!}</textarea>
                                        </div>
                                    </div> --}}
                                </div>

                                <div class="form-group">
                                    <label for="sort" class="title_txt">Sắp xếp (Tăng dần)</label>
                                    <input type="text" name="sort" id="sort" value="{{ $sort ?? 0 }}" class="form-control">
                                </div>

                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->

                        {{-- @include('admin.service.includes.price_stock') --}}


                        <div class="card">
                            <div class="card-header">Quá trình setup</div> <!-- /.card-header -->
                            <div class="card-body">
                                {{-- custom_fields --}}
                                @include('admin.service.includes.custom_fields', ['service_id' => $id])
                                {{-- End custom_fields --}}
                            </div>
                        </div>


                        {{-- <div class="card">
                            <div class="card-header">Gallery</div>
                            <div class="card-body">
                                <div class="form-group">
                                    @include('admin.partials.galleries', ['gallery_images' => $gallery ?? ''])
                                </div>
                            </div>
                        </div> --}}

                    </div> <!-- /.col-9 -->

                    <div class="col-md-3">
                        @include('admin.partials.action_button')

                        {{-- SELECT CATEGORY --}}
                        {{-- <div class="card widget-category">
                            <div class="card-header">
                                <h4>Chuyên mục</h4>
                            </div>
                            <div class="card-body max-vh-75">
                                <div class="inside clear">
                                    @php
                                        $array_checked = isset($service) ? $post->categories->pluck('id')->toArray() : [];
                                        $category_type = 'service';
                                    @endphp
                                    @include('admin.partials.category-item')
                                </div>
                            </div>
                        </div> --}}
                        {{-- END SELECT CATEGORY --}}

                        @include('admin.partials.image', ['title' => 'Hình ảnh', 'id' => 'img', 'name' => 'image', 'image' => $image ?? ''])
                        {{-- @include('admin.partials.image', ['title' => 'Hình ảnh Banner', 'id' => 'cover-img', 'name' => 'cover', 'image' => $cover ?? '']) --}}
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
            // $('.slug_slugify').slugify('.title_slugify');

            // editorQuote('description');
            // editorQuote('description_en');
            // editor('content');
            // editor('content_en');

            $('#thumbnail_file').change(function(evt) {
                $("#thumbnail_file_link").val($(this).val());
                $("#thumbnail_file_link").attr("value", $(this).val());
            });

            //xử lý validate
            $("#frm-create-post").validate({
                rules: {
                    name: "required",
                    'category[]': {
                        required: true,
                        minlength: 1
                    }
                },
                messages: {
                    name: "Nhập tiêu đề tin",
                    'category[]': "Chọn thể loại tin",
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
