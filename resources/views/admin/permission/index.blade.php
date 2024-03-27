@extends('admin.layouts.app')
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
                    <h1 class="m-0 text-dark">List Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">List Users</li>
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
                            <h3 class="card-title">List Users</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                @include('admin.partials.button_add', ['type' => 'permission', 'route' => route('admin_permission.create')])
                                {{-- <ul class="nav fl">
                                    <li class="nav-item">
                                        <a class="btn btn-danger" id="btn_deletes" onclick="delete_id('user_admin')" href="javascript:void(0)"><i class="fas fa-trash"></i> Delete</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="btn btn-primary" href="{{ route('admin_permission.create') }}" style="margin-left: 6px;"><i class="fas fa-plus"></i> Add New</a>
                                    </li>
                                </ul> --}}
                            </div>

                            <div class="d-flex align-items-center justify-content-between my-4">
                                {{-- <div class="fl">
                                    <b>@lang('admin.Total')</b>: <span class="bold" style="color: red; font-weight: bold;">{{ $total_item ?? 0 }}</span> @lang('admin.Users')
                                </div>
                                <div class="fr">
                                    {!! $permissions->links() !!}
                                </div> --}}
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
                                            <th scope="col">@lang('admin.Name')</th>
                                            <th scope="col">@lang('admin.Slug')</th>
                                            <th scope="col">Http path</th>
                                            <th scope="col">@lang('admin.Action')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($permissions as $data)
                                            <tr>
                                                <td class="text-center">
                                                    <div class="icheck-info d-inline">
                                                        <input type="checkbox" id="{{ $data->id }}" name="seq_list[]" value="{{ $data->id }}">
                                                        <label for="{{ $data->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin_permission.edit', $data->id) }}" title="">{{ $data->name }}</a>
                                                </td>
                                                <td>{{ $data->slug }}</td>
                                                <td>
                                                    @php
                                                        $permissions = '';
                                                        if ($data->http_uri) {
                                                            $methods = array_map(function ($value) {
                                                                $route = explode('::', $value);
                                                                $methodStyle = '';
                                                                if ($route[0] == 'ANY') {
                                                                    $methodStyle = '<span class="badge badge-info">' . $route[0] . '</span>';
                                                                } elseif ($route[0] == 'POST') {
                                                                    $methodStyle = '<span class="badge badge-warning">' . $route[0] . '</span>';
                                                                } else {
                                                                    $methodStyle = '<span class="badge badge-primary">' . $route[0] . '</span>';
                                                                }
                                                                return $methodStyle . ' <code>' . $route[1] . '</code>';
                                                            }, explode(',', $data->http_uri));
                                                            $permissions = implode('<br>', $methods);
                                                        }
                                                    @endphp
                                                    {!! $permissions !!}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin_permission.edit', $data->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i> Edit</a><a href="" title=""></a>
                                                    <a href="{{ route('admin_permission.delete', $data->id) }}" class="btn btn-danger btn-sm btn_deletes"><i class="fa fa-trash"></i> Remove</a><a href="" title=""></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- /.card-body -->
                    </div><!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.btn_deletes').click(function() {
                if (confirm('Bạn có chắc muốn xóa tài khoản?')) {
                    return true;
                }
                return false;
            });

        });
    </script>
@endpush
