@extends('admin.layouts.app')
@section('seo')
    @php
        $data_seo = [
            'title' => 'Sản phẩm | ' . Helpers::get_option_minhnn('seo-title-add'),
            'keywords' => Helpers::get_option_minhnn('seo-keywords-add'),
            'description' => Helpers::get_option_minhnn('seo-description-add'),
            'og_title' => 'Sản phẩm | ' . Helpers::get_option_minhnn('seo-title-add'),
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
            <div class="row">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product</li>
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
                            <h3>Product</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <div class="clear">

                                @include('admin.partials.button_add_delete', ['type' => 'product', 'route' => route('admin.productCreate')])

                                <div class="fr mb-4">
                                    <form method="GET" action="" id="frm-filter-post" class="form-inline">
                                        @php
                                            $list_cate = App\Models\Category::where('status', 1)->where('type', 'product')->where('parent', 0)->select('id', 'name')->get();
                                        @endphp
                                        <select class="custom-select mr-2" name="category_id">
                                            <option value="">Danh mục</option>
                                            @foreach ($list_cate as $cate)
                                                <option value="{{ $cate->id }}" {{ request('category_id') == $cate->id ? 'selected' : '' }}>{{ $cate->name }}</option>
                                                @if ($cate->children('product')->get())
                                                    @foreach ($cate->children('product') as $cate_child)
                                                        <option value="{{ $cate_child->id }}" {{ request('category_id') == $cate_child->id ? 'selected' : '' }}> &ensp;&ensp;{{ $cate_child->name }}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control" name="search_name" id="search_name" placeholder="Tìm kiếm SP" value="{{ request('search_name') }}">
                                        <button type="submit" class="btn btn-primary ml-2">Search</button>
                                    </form>
                                </div>
                            </div>

                            <div class="d-flex mb-4 justify-content-between">
                                <div class="fl" style="font-size: 17px;">
                                    <b>Tổng</b>: <span class="bold" style="color: red; font-weight: bold;">{{ $total_item ?? 0 }}</span> sản phẩm
                                </div>
                                <div class="fr">
                                    {!! $data->links() !!}
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered list-data v-center" id="table_index">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:50px">
                                                <div class="icheck-info d-inline">
                                                    <input type="checkbox" id="selectall" onclick="select_all()">
                                                    <label for="selectall">
                                                    </label>
                                                </div>
                                            </th>
                                            <th scope="col" class="text-center" style="width:100px">Ưu tiên</th>
                                            <th scope="col" class="text-center">Tên sản phẩm</th>
                                            <th scope="col" class="text-center">Hình ảnh</th>
                                            <th scope="col" class="text-center">Danh mục</th>
                                            <th scope="col" class="text-center">Ngày</th>
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
                                                    <a class="row-title mr-3" href="{{ route('admin.productEdit', [$item->id]) }}">
                                                        <b>{{ $item->name }}</b>
                                                    </a>
                                                    <br>
                                                    <a class="link to-link fw-bold" href="{{ route('product.detail', $item->slug) }}" target="_blank">
                                                        <span>URL: </span>{{ route('product.detail', $item->slug) }}
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->image != '')
                                                        <img src="{{ get_image($item->image) }}" style="height: 70px;">
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                        $categories = $item->categories;
                                                    @endphp
                                                    @foreach ($categories as $k => $category)
                                                        <a class="link" target="_blank" href="{{ route('admin.productCategoryEdit', $category->id) }}">{{ $category->name }}</a> </br>
                                                    @endforeach
                                                </td>
                                                {{-- <td class="text-center">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">$</span>
                                                        </div>
                                                        <input type="text" id="{{ $data->id }}" class="form-control quick_change_price" value="{{ number_format($data->price, 6, '.', ',') }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">{{ $data->unit_qly }} {{ $data->unit }}</span>
                                                        </div>
                                                    </div>
                                                </td> --}}
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
