@extends('admin.layouts.app')
@php
    if (isset($edit_data)) {
        extract($edit_data->toArray());
    }

    $title_head = $name ?? __('Add shortcode');

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
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.shortcodePost') }}" method="POST" id="frm-create-post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? 0 }}">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-capitalize">{{ $title_head }}</h3>
                            </div>
                            <div class="card-body">
                                {{-- show error form --}}
                                <div class="errorTxt"></div>

                                {{-- <ul class="nav nav-tabs hidden" id="tabLang" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="vi-tab" data-toggle="tab" href="#vi" role="tab" aria-controls="vi" aria-selected="true">@lang('admin.Vietnamese')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">@lang('admin.English')</a>
                                    </li>
                                </ul> --}}
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                                        <div class="form-group">
                                            <label for="name">@lang('admin.Title')</label>
                                            <input type="text" class="form-control title_slugify" id="name" name="name" placeholder="@lang('admin.Title')" value="{{ $name ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">@lang('admin.Description')</label>
                                            <textarea id="description" name="description">{!! $description ?? '' !!}</textarea>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="form-group">
                                            <label for="name_en">@lang('admin.Title')</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Title" value="{{ $name_en ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description_en">@lang('admin.Description')</label>
                                            <textarea id="description_en" name="description_en">{!! $description_en ?? '' !!}</textarea>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h5>@lang('Infomation')</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="sort" class="col-form-label text-lg-right">@lang('Sort')</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="{{ $sort ?? 0 }}">
                                </div>
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
                    </div>

                    <div class="col-md-3">
                        @include('admin.partials.action_button')

                        @include('admin.partials.image', ['title' => __('admin.Thumbnail'), 'id' => 'img', 'name' => 'image', 'image' => $image ?? ''])
                        {{-- @include('admin.partials.image', ['title' => 'Hình ảnh Banner', 'id' => 'cover-img', 'name' => 'cover', 'image' => $cover ?? '']) --}}
                    </div>
                </div> <!-- /.row -->


            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            // $('.slug_slugify').slugify('.title_slugify');

            editorQuote('description');

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
