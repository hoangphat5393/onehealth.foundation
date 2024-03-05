@extends('admin.layouts.app')
@section('seo')
@php
$data_seo = [
'title' => 'List Slider | ' . Helpers::get_option_minhnn('seo-title-add'),
'keywords' => Helpers::get_option_minhnn('seo-keywords-add'),
'description' => Helpers::get_option_minhnn('seo-description-add'),
'og_title' => 'List Slider | ' . Helpers::get_option_minhnn('seo-title-add'),
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

@push('style')
<link rel="stylesheet" href="{{ asset('plugin/DataTables/datatables.min.css') }}">
@endpush

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">List Slider</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">List Slider</li>
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
                        <h3 class="card-title">List Slider</h3>
                    </div> <!-- /.card-header -->
                    <div class="card-body">

                        <div class="clear">
                            @include('admin.partials.button_add_delete', ['type' => 'slider', 'route' => route('admin.createSlider')])
                        </div>
                        <br />

                        <table class="table table-bordered" id="table_index"></table>

                        @push('scripts')
                        <script>
                            $(function() {
                                let data2 = {
                                    !!$data_slider!!
                                };
                                $('#table_index').DataTable({
                                    data: data2,
                                    columns: [{
                                            title: '<input type="checkbox" id="selectall" onclick="select_all()">',
                                            data: 'id'
                                        },
                                        {
                                            title: 'Shortcode',
                                            data: 'id'
                                        },
                                        {
                                            title: 'Title',
                                            data: 'name'
                                        },
                                        {
                                            title: 'Thumbnail',
                                            data: 'src'
                                        },
                                        {
                                            title: 'Created',
                                            data: 'created'
                                        },
                                    ],
                                    order: [
                                        [3, "desc"]
                                    ],
                                    columnDefs: [{ //ID
                                            visible: true,
                                            targets: 0,
                                            className: 'text-center',
                                            orderable: false,
                                            render: function(data, type, full, meta) {
                                                return '<input type="checkbox" id="' + data + '" name="seq_list[]" value="' + data + '">';
                                            }
                                        },
                                        { //ID
                                            visible: true,
                                            targets: 1,
                                            className: 'text-center',
                                            orderable: false,
                                            render: function(data, type, full, meta) {
                                                return '[slider id="' + data + '" items="4"]';
                                            }
                                        },
                                        { //Title
                                            visible: true,
                                            targets: 2,
                                            className: 'text-center',
                                            render: function(data, type, full, meta) {
                                                return '<a href="{{ route('
                                                admin.dashboard ') }}/slider/' + full.id + '"><b>' + data + '</b></a>';
                                            }
                                        },
                                        { //Thumbnail
                                            visible: true,
                                            targets: 3,
                                            className: 'text-center',
                                            render: function(data, type, full, meta) {
                                                if (data != '') {
                                                    return '<img src="' + data + '" style="height: 70px;">';
                                                } else {
                                                    return '';
                                                }
                                            }
                                        },
                                        { //Created
                                            visible: true,
                                            targets: 4,
                                            className: 'text-center',
                                            render: function(data, type, full, meta) {
                                                if (full.status == 1) {
                                                    var st = moment(full.created_at).format('YYYY-MM-DD, h:mm:ss a') + '</br><span class="badge badge-primary">Public</span>';
                                                } else {
                                                    var st = moment(full.created_at).format('YYYY-MM-DD, h:mm:ss a') + '</br><span class="badge badge-secondary">Draft</span>';
                                                }
                                                return st;
                                            }
                                        }
                                    ],
                                });
                            });
                        </script>
                        @endpush
                    </div> <!-- /.card-body -->
                </div><!-- /.card -->
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
</section>
@endsection

@push('scripts')
<script src="{{ asset('plugin/DataTables/datatables.min.js') }}"></script>
@endpush