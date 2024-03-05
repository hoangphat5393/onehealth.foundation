@extends('admin.layouts.app')
@section('seo')
    @php
        $title_head = 'Product Category';
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
                            <h5>{{ trans('admin.project_category') }}</h5>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <div class="clear">
                                @include('admin.partials.button_add_delete', ['type' => 'page', 'route' => route('admin.createPage')])
                            </div>
                            <br />
                            <div class="clear">
                                <div class="fr">
                                    {!! $pages->links() !!}
                                </div>
                            </div>
                            <br />
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_index">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">
                                                <div class="icheck-info d-inline">
                                                    <input type="checkbox" id="selectall" onclick="select_all()">
                                                    <label for="selectall">
                                                    </label>
                                                </div>
                                            </th>
                                            <th scope="col" class="text-center" style="width:100px">Thứ tự</th>
                                            <th scope="col" class="text-center">Tên trang</th>
                                            <th scope="col" class="text-center">Ảnh</th>
                                            <th scope="col" class="text-center">Ngày tạo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($pages->count())
                                            @include('admin.page.includes.page_item', ['level' => 0, 'pages' => $pages])
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="fr">
                                {!! $pages->links() !!}
                            </div>
                        </div> <!-- /.card-body -->
                    </div><!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </section>
@endsection
