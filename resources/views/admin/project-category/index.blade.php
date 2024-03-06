@extends('admin.layouts.app')
@section('seo')
    @php
        $title_head = 'Thể loại sản phẩm';
        $data_seo = [
            'title' => $title_head . ' | ' . Helpers::get_option_minhnn('seo-title-add'),
            'keywords' => Helpers::get_option_minhnn('seo-keywords-add'),
            'description' => Helpers::get_option_minhnn('seo-description-add'),
            'og_title' => 'List Category Product | ' . Helpers::get_option_minhnn('seo-title-add'),
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
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5>Danh sách chuyên mục bài viết</h5>
                        </div>

                        <div class="card-body">
                            <div class="clear">
                                @include('admin.partials.button_add_delete', ['type' => 'project-category', 'route' => route('admin.projectCategoryCreate')])
                            </div>

                            <div class="d-flex my-4">
                                <div class="fl" style="font-size: 17px;">
                                    <b>Tổng</b>: <span class="bold" style="color: red; font-weight: bold;">{{ $total_item ?? 0 }}</span> Loại
                                </div>
                                <div class="fr">
                                    {!! $categories->links() !!}
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered v-center" id="table_index">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center" style="width:80px">
                                                <div class="icheck-info d-inline">
                                                    <input type="checkbox" id="selectall" onclick="select_all()"><label for="selectall">
                                                    </label>
                                                </div>
                                            </th>
                                            <th scope="col" class="text-center" style="width:90px">Thứ tự</th>
                                            <th scope="col" class="text-center">Tên chuyên mục</th>
                                            <th scope="col" class="text-center">Ảnh đại diện</th>
                                            <th scope="col" class="text-center">Ngày tạo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($categories->count())
                                            @include('admin.project-category.includes.category_item', ['level' => 0, 'categories' => $categories])
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="fr">
                                {!! $categories->links() !!}
                            </div>
                        </div> <!-- /.card-body -->
                    </div><!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </section>
@endsection
