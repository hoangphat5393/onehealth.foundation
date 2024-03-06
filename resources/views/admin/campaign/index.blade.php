@extends('admin.layouts.app')
@section('seo')
    @php
        $title_head = 'Bài viết';
        $data_seo = [
            'title' => 'Tin tức | ' . Helpers::get_option_minhnn('seo-title-add'),
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title_head }}</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <div class="clear">
                                @include('admin.partials.button_add_delete', ['type' => 'post', 'route' => route('admin.postCreate')])
                                <div class="fr">
                                    <form method="GET" action="" id="frm-filter-post" class="form-inline">
                                        @php
                                            $categories = App\Models\Category::select('id', 'name')->where('type', 'post')->orderByDesc('sort')->get();
                                        @endphp
                                        <select class="custom-select mr-2" name="category_id">
                                            <option value="">Thể loại tin tức</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" {{ request('category_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control" name="search_name" id="search_name" placeholder="Từ khoá" value="{{ request('search_name') }}">
                                        <button type="submit" class="btn btn-primary ml-2">Tìm kiếm</button>
                                    </form>
                                </div>
                            </div>
                            <br />
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
                                            <th class="text-center" style="width:100px">Ưu tiên</th>
                                            <th class="text-center">Tên</th>
                                            {{-- <th class="text-center" style="width:150px">Chuyên mục</th> --}}
                                            <th class="text-center">Ảnh đại diện</th>
                                            <th class="text-center">Ngày đăng</th>
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
                                                <td class="text-center">
                                                    <input type="text" id="sort" class="form-control quick_change_value text-center" data-id="{{ $item->id }}" data-model="{{ get_class($item) }}" value="{{ $item->sort }}" reload-on-change>
                                                </td>
                                                <td>
                                                    <a class="row-title fw-bold" href="{{ route('admin.campaignEdit', $item->id) }}">
                                                        {{ $item->name }}
                                                    </a>
                                                    <br>
                                                    <a class="link to-link fw-bold" href="{{ route('news.detail', [$item->slug, $item->id]) }}" target="_blank">
                                                        <span>URL: </span>{{ route('news.detail', [$item->slug, $item->id]) }}
                                                    </a>
                                                </td>
                                                {{-- <td class="text-center">
                                                    @php
                                                        $categories = $item->categories;
                                                    @endphp
                                                    @foreach ($categories as $k => $category)
                                                        <a class="link" target="_blank" href="{{ route('admin.postCategoryEdit', $category->id) }}">{{ $category->name }}</a></br>
                                                    @endforeach
                                                </td> --}}
                                                <td class="text-center">
                                                    <img src="{{ get_image($item->image) }}" style="height: 70px;">
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->updated_at }}
                                                    <br>
                                                    <input type="checkbox" id="status" class="quick_change_value" @checked($item->status == 1) value="1" value-off="0" data-id="{{ $item->id }}" data-model="{{ get_class($item) }}" data-toggle="toggle" data-on="Công khai" data-off="Bản nháp"
                                                        data-onstyle="success" data-offstyle="light">
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
