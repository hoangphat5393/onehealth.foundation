@extends('admin.layouts.app')
@php
    $title_head = 'Dự án';

    if (isset($project)) {
        extract($project->toArray());
        $gallery = isset($gallery) || $gallery != '' ? unserialize($gallery) : '';
    } else {
        $title_head = 'Thêm dự án mới';
    }
    $date_update = $updated_at ?? date('Y-m-d H:i:s');
    $is_hot = $is_hot ?? 0;
@endphp
@section('seo')
    @php
        $data_seo = [
            'title' => $title_head . ' | ' . Helpers::get_option_minhnn('seo-title-add'),
            'keywords' => Helpers::get_option_minhnn('seo-keywords-add'),
            'description' => Helpers::get_option_minhnn('seo-description-add'),
            'og_title' => $title_head . ' | ' . Helpers::get_option_minhnn('seo-title-add'),
            'og_description' => Helpers::get_option_minhnn('seo-description-add'),
            'og_url' => Request::url(),
            'og_img' => asset('images/logo_seo.png'),
            'current_url' => Request::url(),
            'current_url_amp' => '',
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
            <form action="{{ route('admin.projectPost') }}" method="POST" id="frm-create-post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? 0 }}">
                <div class="row">
                    <div class="col-9">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $title_head }}</h4>
                            </div>
                            <div class="card-body">
                                {{-- SHOW ERROR FORM --}}
                                <div class="errorTxt"></div>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control slug_slugify" id="slug" name="slug" placeholder="Slug" value="{{ $slug ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Tên dự án</label>
                                            <input type="text" class="form-control title_slugify" id="name" name="name" placeholder="Tên dư án" value="{{ $name ?? '' }}">
                                        </div>
                                        @include('admin.partials.quote', ['name' => 'description', 'description' => $description ?? ''])
                                        @include('admin.partials.content', ['name' => 'description', 'content' => $content ?? ''])
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="service" class="title_txt">Service</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="service" id="service" value="{{ $service ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="location" class="title_txt">Location</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="location" id="location" value="{{ $location ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="acreage" class="title_txt">Area</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="acreage" id="acreage" value="{{ $acreage ?? 0 }}" aria-describedby="basic-addon2" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">m²</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="price" class="title_txt">Giá</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="price" id="price" value="{{ isset($price) ? number_format($price) : 0 }}" aria-describedby="basic-addon2" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">/ m²</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="acreage" class="title_txt">Diện tích</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="acreage" id="acreage" value="{{ $acreage ?? 0 }}" aria-describedby="basic-addon2" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">m²</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="apartment" class="title_txt">Căn hộ</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="apartment" id="apartment" value="{{ $apartment ?? 0 }}" aria-describedby="basic-addon2" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">căn</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="villa" class="title_txt">Biệt thự/nhà phố</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="villa" id="villa" value="{{ $villa ?? 0 }}" aria-describedby="basic-addon2" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">căn</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- SELECT PLACE --}}
                                {{-- @include('admin.partials.select-place') --}}
                                {{-- END SELECT PLACE --}}

                                <div class="form-group">
                                    <label for="stt" class="title_txt">Ưu tiên (Tăng dần)</label>
                                    <input type="text" name="sort" id="sort" value="{{ $sort ?? 0 }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="is_hot" class="mr-3 col-form-label">Nổi bật</label>
                                    <input id="is_hot" type="checkbox" value="1" name="is_hot" @if ($is_hot == 1) checked @endif data-toggle="toggle">
                                </div>

                                <div class="row d-none">
                                    <div class="form-group col-lg-6">
                                        @php
                                            $stage = \App\Model\Stage::get();
                                        @endphp
                                        @include('admin.partials.select-label', [
                                            'label' => 'Trạng thái',
                                            'options' => $stage ?? '',
                                            'name' => 'stage_id',
                                            'item' => $stage_id ?? '',
                                            'hasDefaultOption' => true,
                                        ])
                                    </div>
                                </div>

                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->
                    </div> <!-- /.col-9 -->

                    <div class="col-3">
                        @include('admin.partials.action_button')

                        {{-- SELECT CATEGORY --}}
                        <div class="card widget-category">
                            <div class="card-header">
                                <h4>Chuyên mục</h4>
                            </div>
                            <div class="card-body">
                                <div class="inside clear">
                                    <div class="clear">
                                        @php
                                            $data_checks = isset($project) ? $project->categories->pluck('id')->toArray() : [];
                                            $array_checked = [];
                                            if ($data_checks):
                                                foreach ($data_checks as $data_check):
                                                    array_push($array_checked, $data_check);
                                                endforeach;
                                            endif;
                                            $categories = App\Model\Category::where('parent', 0)
                                                ->where('type', 'project')
                                                ->orderByDesc('sort')
                                                ->get();
                                        @endphp
                                        @include('admin.project.includes.category-item')
                                    </div>
                                </div>
                            </div>
                        </div>

                        @include('admin.partials.image', ['title' => 'Icon', 'id' => 'img-icon', 'name' => 'icon', 'image' => $icon ?? ''])
                        @include('admin.partials.image', ['title' => 'Hình ảnh', 'id' => 'img', 'name' => 'image', 'image' => $image ?? ''])
                        {{-- @include('admin.partials.image', ['title' => 'Ảnh Cover', 'id' => 'img-cover', 'name' => 'cover', 'image' => $cover ?? '']) --}}

                        {{-- Post Gallery --}}
                        @include('admin.partials.galleries', ['gallery_images' => $gallery ?? ''])
                        {{-- End Post Gallery --}}

                    </div> <!-- /.col-9 -->
                </div> <!-- /.row -->

                {{-- SEO --}}
                <div class="row">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header">SEO</div>
                            <div class="card-body">
                                @include('admin.form-seo.seo')
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END SEO --}}
            </form>
        </div> <!-- /.container-fluid -->
    </section>
@endsection


@push('scripts')
    <script type="text/javascript">
        editorQuote('description');
        editor('content');

        $(function() {
            // $('.slug_slugify').slugify('.title_slugify');

            //Date range picker
            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD hh:mm:ss'
            });

            //xử lý validate
            $("#frm-create-post").validate({
                rules: {
                    title: "required",
                    'category[]': {
                        required: true,
                        minlength: 1
                    }
                },
                messages: {
                    title: "Nhập tiêu đề tin",
                    'category[]': "Chọn thể loại cho dự án",
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
