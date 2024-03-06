@extends('admin.layouts.app')
@section('seo')
    @php
        $data_seo = [
            'title' => 'Tin tức | ' . Helpers::get_option_minhnn('seo-title-add'),
            'keywords' => Helpers::get_option_minhnn('seo-keywords-add'),
            'description' => Helpers::get_option_minhnn('seo-description-add'),
            'og_title' => 'Tin tức | ' . Helpers::get_option_minhnn('seo-title-add'),
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
                    <h1 class="m-0 text-dark">Dự án</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dự án</li>
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
                            <h3 class="card-title">Dự án</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <div class="clear">
                                <ul class="nav fl">
                                    <li class="nav-item">
                                        <a class="btn btn-danger mr-2" onclick="delete_id('project')" href="javascript:void(0)"><i class="fas fa-trash"></i> Xóa</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="btn btn-primary mr-2" href="{{ route('admin.projectCreate') }}"><i class="fas fa-plus"></i> Thêm mới</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="btn btn-primary" onclick="replicate_id('project')" href="javascript:void(0)"><i class="fa-regular fa-copy"></i> Sao chép</a>
                                    </li>
                                </ul>
                                <div class="fr">
                                    <form method="GET" action="" id="frm-filter-post" class="form-inline">
                                        @php
                                            $list_cate = App\Models\Category::select('id', 'name')->where('type', 'project')->orderByDesc('sort')->get();
                                        @endphp
                                        <select class="custom-select mr-2" name="category_id">
                                            <option value="">Thể loại tin tức</option>
                                            @foreach ($list_cate as $cate)
                                                <option value="{{ $cate->id }}" {{ request('category_id') == $cate->id ? 'selected' : '' }}>{{ $cate->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control" name="search_name" id="search_name" placeholder="Từ khoá" value="{{ request('search_name') }}">
                                        <button type="submit" class="btn btn-primary ml-2">Tìm kiếm</button>
                                    </form>
                                </div>
                            </div>
                            <br />
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_index">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:50px">
                                                <div class="icheck-info d-inline">
                                                    <input type="checkbox" id="selectall" onclick="select_all()">
                                                    <label for="selectall">
                                                    </label>
                                                </div>
                                            </th>
                                            <th class="text-center" scope="col" style="width:110px">Độ ưu tiên</th>
                                            <th class="text-center" scope="col">Tên dự án</th>
                                            <th class="text-center" scope="col">Danh mục</th>
                                            <th class="text-center" scope="col">Icon</th>
                                            <th class="text-center" scope="col">Ảnh đại diện</th>
                                            <th class="text-center" scope="col">Ngày</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="text-center">
                                                    <div class="icheck-info d-inline">
                                                        <input type="checkbox" id="{{ $item->id }}" name="seq_list[]" value="{{ $item->id }}">
                                                        <label for="{{ $item->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center" style="width:100px">
                                                    <input type="text" id="sort" class="form-control quick_change_value text-center" reload-on-change data-id="{{ $item->id }}" data-model="{{ get_class($item) }}" value="{{ $item->sort }}">
                                                </td>
                                                <td class="">
                                                    <a class="row-title" href="{{ route('admin.projectEdit', [$item->id]) }}">
                                                        <b>{{ $item->name }}</b>
                                                        <br>
                                                        <a class="text-red fw-bold" href="{{ route('project.detail', [$item->slug, $item->id]) }}">
                                                            {{ route('project.detail', [$item->slug, $item->id]) }}
                                                        </a>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                        $categories = $item->categories;
                                                    @endphp
                                                    @foreach ($categories as $k => $category)
                                                        <a class="link" target="_blank" href="{{ route('admin.postCategoryEdit', $category->id) }}">{{ $category->name }}</a></br>
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ get_image($item->icon) }}" style="height: 50px;">
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ get_image($item->image) }}" style="height: 70px;">
                                                </td>
                                                <td class="text-center py-3">
                                                    <input type="checkbox" id="is_hot" class="quick_change_value" @checked($item->is_hot == 1) value="1" value-off="0" data-id="{{ $item->id }}" data-model="{{ get_class($item) }}" data-toggle="toggle" data-on="Nổi bật"
                                                        data-off="Bình thường" data-onstyle="danger" data-offstyle="light">
                                                    <br>
                                                    {{ $item->updated_at }}
                                                    <br>
                                                    <input type="checkbox" id="status" class="quick_change_value" @checked($item->status == 1) value="1" value-off="0" data-id="{{ $item->id }}" data-model="{{ get_class($item) }}" data-toggle="toggle" data-on="Công khai"
                                                        data-off="Bản nháp" data-onstyle="success" data-offstyle="light">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="fr">
                                {!! $data->links() !!}
                            </div>
                        </div> <!-- /.card-body -->
                    </div><!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </section>
@endsection
