@extends('admin.layouts.app')
@section('seo')
    @php
        $title_head = 'Page';
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
                            <h3>@lang('admin.Page')</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between">
                                @include('admin.partials.button_add_delete', ['type' => 'page', 'route' => route('admin.createPage')])
                                <div class="fr mt-3 mt-lg-0 d-none">
                                    <form method="GET" action="" id="frm-filter-post" class="form-inline">
                                        <input type="text" class="form-control" name="search_name" id="search_name" placeholder="@lang('admin.Keyword')" value="{{ request('search_name') }}">
                                        <button type="submit" class="btn btn-primary ml-2">@lang('admin.Search')</button>
                                    </form>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center my-4">
                                <div class="fl">
                                    <b>@lang('admin.Total')</b>: <span class="fw-bold text-red">{{ $total_item ?? 0 }}</span> @lang('admin.News')
                                </div>
                                <div class="fr">
                                    {!! $pages->links() !!}
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered list-data v-center" id="table_index">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:50px">
                                                <div class="icheck-info d-inline">
                                                    <input type="checkbox" id="selectall" onclick="select_all()">
                                                    <label for="selectall"></label>
                                                </div>
                                            </th>
                                            <th scope="col" class="text-center" style="width:100px">@lang('admin.Sort')</th>
                                            <th scope="col" class="text-center">@lang('admin.name')</th>
                                            <th scope="col" class="text-center">@lang('admin.thumbnail')</th>
                                            <th class="text-center">@lang('admin.Createdby')</th>
                                            <th scope="col" class="text-center">@lang('admin.Createddate')</th>
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
