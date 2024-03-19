@extends('admin.layouts.app')
@php
    if (isset($data_slider)) {
        $title = $data_slider->name;
        $post_title = $data_slider->name;
        $link = $data_slider->link;
        $src = $data_slider->src;
        $src_mobile = $data_slider->src_mobile;
        $sort = $data_slider->sort;
        $status = $data_slider->status;
        $target = $data_slider->target;
        $date_update = $data_slider->updated_at;
        $sid = $data_slider->id;
    } else {
        $title = 'Create Slider';
        $post_title = '';
        $link = '';
        $src = '';
        $src_mobile = '';
        $sort = 0;
        $status = 1;
        $target = '_top';
        $date_update = date('Y-m-d h:i:s');
        $sid = 0;
    }
@endphp


@section('seo')
    @php
        $data_seo = [
            'title' => $title . ' | ' . Helpers::get_option_minhnn('seo-title-add'),
            'keywords' => Helpers::get_option_minhnn('seo-keywords-add'),
            'description' => Helpers::get_option_minhnn('seo-description-add'),
            'og_title' => $title . ' | ' . Helpers::get_option_minhnn('seo-title-add'),
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
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.postSliderDetail') }}" method="POST" id="frm-slider" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="sid" value="{{ $sid }}">
                <div class="row">
                    <div class="col-9">
                        <div class="card">
                            <div class="card-header">
                                <h3>{{ $title }}</h3>
                            </div> <!-- /.card-header -->
                            <div class="card-body">
                                @if ($sid)
                                    <p class="mb-3">Shortcode: <span style="background: #f1f1f1; display: inline-block; padding: 3px">[slider id="{{ $sid }}" items="4"]</span></p>
                                @endif
                                {{-- @php
                                    $lc = app()->getLocale();
                                @endphp --}}
                                {{-- show error form --}}
                                <div class="errorTxt"></div>
                                <div class="form-group">
                                    <label for="post_title">@lang('admin.Name')</label>
                                    <input type="text" class="form-control title_slugify" id="post_title" name="post_title" placeholder="Tiêu đề" value="{{ $post_title }}">
                                </div>

                                <div class="form-group">
                                    <label for="post_title">@lang('admin.Sort')</label>
                                    <input type="text" class="form-control" id="sort" name="sort" placeholder="Thứ tự" value="{{ $sort }}">
                                </div>
                                <div class="form-group d-none">
                                    <label>Upload Images</label>
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="text" name="slishow_upload" class="form-control" id="csv_upload_slishow" value="{{ $src }}" autocomplete="off" />
                                        </div>
                                        <div class="col-3">
                                            <button type="button" id="img-slider" class="btn btn-primary ckfinder-popup" data-show="output_slishow_pc" data="csv_upload_slishow">Select IMG</button>
                                        </div>
                                    </div>
                                    <div class="clear mt-1">
                                        @if ($src != '')
                                            <img id="output_slishow_pc" class="output_slishow_pc" src="{{ $src }}" width="400" />
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group d-none">
                                    <label>Upload Images Mobile</label>
                                    <div class="clear">
                                        <div class="file_csv_up" id="text_input_file_mobile">
                                            <input type="text" name="slishow_upload_mobile" class="form-control" id="csv_upload_slishow_mobile" value="{{ $src_mobile }}" autocomplete="off" />
                                        </div>
                                        <div id="csv_upload_mobile" class="csv_tbl_submit_body">
                                            <input type="file" id="csv_slishow_mobile" name="csv_slishow_mobile" onchange="loadFileSlishow_mobile(event)" />Choose File
                                        </div>
                                    </div>
                                    <div class="clear mt-1">
                                        <img id="output_slishow_mobile" src="{{ $src_mobile }}" />
                                    </div>
                                </div>

                                <div class="form-group d-none">
                                    <label for="target">Target</label>
                                    <select name="target" id="target" class="selectbox form-control">
                                        <option value="_top" @if ($target == '_top') selected @endif>_top</option>
                                        <option value="_blank" @if ($target == '_blank') selected @endif>_blank</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h4 class="border-bottom mt-4 mb-2">@lang('admin.Image list')</h4>
                                    @if ($sid == 0)
                                        <p style="color: #f00;">Vui lòng bấm cập nhật để thêm ảnh</p>
                                    @else
                                        <div class="text-right">
                                            <button type="button" class="btn btn-info edit-slider" data="0" data-parent="{{ $sid }}">@lang('admin.Add image')</button>
                                        </div>
                                        <div class="col-lg-12 slider-items mt-3">
                                            <div class="row border py-2 mb-4">
                                                <div class="col-lg-3 text-center">@lang('admin.Image')</div>
                                                <div class="col-lg-3">@lang('admin.Name')</div>
                                                <div class="col-lg-3">@lang('admin.Link')</div>
                                                <div class="col-lg-3 text-center">@lang('admin.Action')</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 slider-list">
                                            @include('admin.slider-home.includes.slider-items', ['sliders' => $sliders])
                                        </div>
                                    @endif
                                </div>
                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->
                    </div> <!-- /.col-9 -->

                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">@lang('admin.Publish')</h3>
                            </div> <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioDraft" name="status" value="0" @if ($status == 0) checked @endif>
                                        <label for="radioDraft">@lang('admin.Draft')</label>
                                    </div>
                                    <div class="icheck-primary d-inline" style="margin-left: 15px;">
                                        <input type="radio" id="radioPublic" name="status" value="1" @if ($status == 1) checked @endif>
                                        <label for="radioPublic">@lang('admin.Publish')</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>@lang('admin.Createddate'):</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="created_at" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{ $date_update }}">
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success">@lang('admin.Save')</button>
                                </div>
                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->
                    </div> <!-- /.col-9 -->
                </div> <!-- /.row -->
            </form>
        </div> <!-- /.container-fluid -->
    </section>
    <div class="content-html">

    </div>

    <!-- Modal -->
    <div class="modal fade" id="sliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('admin.Add image')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <div class="errorTxtModal col-lg-12" style="color: #f00;"></div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('admin.Close')</button>
                    <button type="button" class="btn btn-info post-slider">@lang('admin.Save')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $(".slider-list").sortable({
                update: function(event, ui) {
                    console.log('fdfd');
                    var form = document.getElementById('frm-slider');
                    var fdnew = new FormData(form);
                    axios({
                        method: 'POST',
                        url: 'admin/slider/sort',
                        data: fdnew,
                    }).then(res => {}).catch(e => console.log(e));
                }
            });
        });
    </script>

    <script>
        // SLIDER INSERT
        $(function() {
            var sliderModal = $("#sliderModal");
            if (sliderModal.length > 0) {
                $("#form-inserSlider, #form-editSlider").validate({
                    onfocusout: false,
                    onkeyup: false,
                    onclick: false,
                    rules: {
                        name: "required",
                        src: "required",
                    },
                    messages: {
                        name: "Vui lòng nhập tên",
                        src: "Chọn hình ảnh",
                    },
                    errorElement: "div",
                    errorLabelContainer: ".errorTxtModal",
                    invalidHandler: function(event, validator) {},
                });

                $(document).on("click", ".post-slider", function() {
                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }
                    //rest of your code

                    var type = $(this).attr("data");

                    from = $("#form-editSlider");

                    if (from.valid()) {
                        var dataString = from.serialize();
                        axios({
                                method: "POST",
                                url: "/admin/slider/insert",
                                data: dataString,
                            })
                            .then((res) => {
                                if (res.data.view != "") {
                                    // $('#inserSlider form')[0].reset();
                                    $("#sliderModal").modal("hide");

                                    $(".slider-list").html(res.data.view);
                                }
                            })
                            .catch((e) => console.log(e));
                    }
                });
            }
        });

        // EDIT SLIDER
        $(document).on("click", ".edit-slider", function() {
            var id = $(this).attr("data"),
                parent = $(this).data("parent");
            if (id) {
                axios({
                        method: "POST",
                        url: "/admin/slider/edit",
                        data: {
                            id: id,
                            parent: parent
                        },
                    })
                    .then((res) => {
                        if (res.data.view != "") {
                            $("#sliderModal .modal-body").html(res.data.view);
                            $("#sliderModal").modal("show");

                            editorQuote("description");
                            editorQuote("description_en");

                            $(".ckfinder-popup").each(function(index, el) {
                                var id = $(this).attr("id"),
                                    input = $(this).attr("data"),
                                    view_img = $(this).data("show");
                                var button1 = document.getElementById(id);
                                button1.onclick = function() {
                                    selectFileWithCKFinder(input, view_img);
                                };
                            });
                        }
                    })
                    .catch((e) => console.log(e));
            }
        });

        // DELETE SLIDER
        $(document).on("click", ".delete-slider", function() {
            var id = $(this).attr("data"),
                this_ = $(this);
            if (id) {
                axios({
                        method: "POST",
                        url: "/admin/slider/delete",
                        data: {
                            id: id
                        },
                    })
                    .then((res) => {
                        // console.log(res.data.view);
                        $(".slider-list").html(res.data.view);
                        // if (res.data.view != "") $(".slider-list").html(res.data.view);
                    })
                    .catch((e) => console.log(e));
            }
        });
    </script>
@endpush
