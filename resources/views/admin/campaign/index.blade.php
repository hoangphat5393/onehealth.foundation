@extends('admin.layouts.app')
@section('seo')
    @php
        $title_head = __('admin.Campaign');
        $data_seo = [
            'title' => __('admin.Campaign') . ' | ' . Helpers::get_option_minhnn('seo-title-add'),
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
                            <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between">
                                @include('admin.partials.button_add_delete', ['type' => 'campaign', 'route' => route('admin.campaignCreate')])
                                <div class="fr mt-3 mt-lg-0">
                                    <form method="GET" action="" id="frm-filter-post" class="form-inline">
                                        {{-- @php
                                            $categories = App\Models\Category::select('id', 'name')->where('type', 'post')->orderByDesc('sort')->get();
                                        @endphp
                                        <select class="custom-select mr-2" name="category_id">
                                            <option value="">Thể loại tin tức</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" {{ request('category_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select> --}}
                                        <input type="text" class="form-control" name="search_name" id="search_name" placeholder="@lang('admin.Keyword')" value="{{ request('search_name') }}">
                                        <button type="submit" class="btn btn-primary ml-2">@lang('admin.Search')</button>
                                    </form>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center my-4">
                                <div class="fl">
                                    <b>@lang('admin.Total')</b>: <span class="fw-bold text-red">{{ $total_item ?? 0 }}</span> @lang('admin.Campaigns')
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
                                                    <label for="selectall"></label>
                                                </div>
                                            </th>
                                            <th class="text-center" style="width:100px">@lang('admin.priority')</th>
                                            <th class="text-center">@lang('admin.Name')</th>
                                            <th class="text-center">@lang('admin.thumbnail')</th>
                                            <th class="text-center">@lang('admin.Createdby')</th>
                                            <th class="text-center">@lang('admin.Createddate')</th>
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
                                                        {{ $item->name }} | {{ $item->name_en }}
                                                    </a>
                                                    <br>
                                                    <a class="link to-link fw-bold" href="{{ route('campaign.detail', [$item->slug, $item->id]) }}" target="_blank">
                                                        <span>URL VI: </span>{{ route('campaign.detail', [$item->slug, $item->id]) }}
                                                    </a>
                                                    <br>
                                                    <a class="link to-link fw-bold" href="{{ route('campaign.detail', [$item->slug, $item->id], true, 'en') }}" target="_blank">
                                                        <span>URL EN: </span>{{ route('campaign.detail', [$item->slug, $item->id], true, 'en') }}
                                                    </a>
                                                </td>

                                                <td class="text-center">
                                                    <img src="{{ get_image($item->image) }}" style="height: 70px;">
                                                </td>
                                                <td>
                                                    <div class="w-fit-content mx-auto">{{ $item->admin->name }}</div>
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->updated_at }}
                                                    <br>
                                                    <input type="checkbox" id="status" class="quick_change_value" @checked($item->status == 1) value="1" value-off="0" data-id="{{ $item->id }}" data-model="{{ get_class($item) }}" data-toggle="toggle" data-on="@lang('admin.Publish')"
                                                        data-off="@lang('admin.Draft')" data-onstyle="success" data-offstyle="light">
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
