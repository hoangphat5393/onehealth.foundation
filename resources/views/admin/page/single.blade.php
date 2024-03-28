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

    // $lc = app()->setLocale();

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
                                <h3 class="card-title">@lang('admin.Page')</h3>
                            </div> <!-- /.card-header -->
                            <div class="card-body">
                                <!-- show error form -->
                                <div class="errorTxt"></div>
                                <div class="form-group">
                                    <label for="post_slug">@lang('admin.Slug')</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $slug ?? '' }}">
                                    {{-- #0000cc --}}
                                    @if ($id > 0)
                                        <p class="my-2">
                                            <strong class="text-primary">Link Vi:</strong>
                                            <u><i><a href="{{ route('page', $slug) }}" target="_blank" class="text-red">{{ route('page', $slug) }}</a></i></u>
                                        </p>
                                        <p>
                                            <strong class="text-primary">Link EN:</strong>
                                            <u><i><a href="{{ route('page', $slug, true, 'en') }}" target="_blank" class="text-red">{{ route('page', $slug, true, 'en') }}</a></i></u>
                                        </p>
                                    @endif
                                </div>
                                <ul class="nav nav-tabs hidden" id="tabLang" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="vi-tab" data-toggle="tab" href="#vi" role="tab" aria-controls="vi" aria-selected="true">@lang('admin.Vietnamese')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">@lang('admin.English')</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                                        <div class="form-group">
                                            <label for="post_title">@lang('admin.Title')</label>
                                            <input type="text" class="form-control" id="post_title" name="title" placeholder="@lang('admin.Title')" value="{{ $title ?? '' }}">
                                        </div>
                                        @php
                                            // $quote_arr = ['id' => 'description', 'label' => 'Trích dẫn', 'name' => 'description', 'description' => $description ?? ''];
                                            $content_arr = ['id' => 'content', 'label' => __('admin.Content'), 'name' => 'content', 'content' => $content ?? ''];
                                            // $content_arr2 = ['id' => 'content2', 'label' => 'Nội dung 2', 'name' => 'content2', 'content' => $content2 ?? ''];
                                        @endphp
                                        {{-- @include('admin.partials.quote', $quote_arr) --}}
                                        @include('admin.partials.content', $content_arr)
                                    </div>
                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="form-group">
                                            <label for="title_en">@lang('admin.Title')</label>
                                            <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Title" value="{{ $title_en ?? '' }}">
                                        </div>
                                        @php
                                            // $quote_arr = ['id' => 'description_en', 'label' => 'Description', 'name' => 'description_en', 'description' => $description_en ?? ''];
                                            $content_arr = ['id' => 'content_en', 'label' => __('admin.Content'), 'name' => 'content_en', 'content' => $content_en ?? ''];
                                            // $content_arr2 = ['id' => 'content2_en', 'label' => 'Content 2', 'name' => 'content2_en', 'content' => $content2_en ?? ''];
                                        @endphp
                                        {{-- @include('admin.partials.quote', $quote_arr) --}}
                                        @include('admin.partials.content', $content_arr)
                                    </div>
                                </div>

                                <div class="form-group d-none">
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
                        @include('admin.partials.image', ['title' => 'Banner', 'id' => 'img', 'name' => 'image', 'image' => $image ?? ''])
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
        // editorQuote('description');
        // editorQuote('description_en');
        editor('content');
        // editor('content2');
        // editor('content3');

        editor('content_en');
        // editor('content2_en');
        // editor('content3_en');

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
