@php
    if (isset($slider)) {
        extract($slider->toArray());
    }
@endphp

<form id="form-editSlider" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="{{ $id ?? 0 }}">
    <input type="hidden" name="slider_id" value="{{ $parent ?? 0 }}">
    {{-- <div class="form-group">
        <label for="sub_name">Tên phụ</label>
        <input type="text" class="form-control" id="sub_name" name="sub_name" value="{{ $sub_name ?? '' }}">
    </div> --}}

    <div class="form-group">
        <label for="name">@lang('admin.Image')</label>
        <div class="inserIMG">
            <input type="hidden" name="image" id="src-img" value="{{ $image ?? '' }}">
            @if (isset($image) && $image != '')
                <img src="{{ get_image($image) }}" id="show-img" class="show-img src-img ckfinder-popup" data-show="show-img" data="src-img" width="200">
            @else
                <img src="{{ asset('images/placeholder.png') }}" id="show-img" class="src-img ckfinder-popup" data-show="show-img" data="src-img" width="200">
            @endif
            <span class="remove-icon ml-3">
                <i class="fa-solid fa-xmark fa-lg"></i>
            </span>
        </div>
    </div>

    <div class="form-group">
        <label for="link">@lang('admin.Link')</label>
        <input type="text" class="form-control" name="link" value="{{ $link ?? '' }}">
    </div>

    <div class="form-group">
        <label for="link">@lang('admin.Link name')</label>
        <input type="text" class="form-control" name="link_name" value="{{ $link_name ?? '' }}">
    </div>

    <ul class="nav nav-tabs hidden" id="tabLang" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="vi-tab" data-toggle="tab" href="#vi" role="tab" aria-controls="vi" aria-selected="true">@lang('admin.Vietnamese')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">@lang('admin.English')</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
            <div class="form-group">
                <label for="name">@lang('admin.Title')</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $name ?? '' }}" placeholder="@lang('admin.Title')">
            </div>
            <div class="form-group">
                <label for="description">@lang('admin.Description')</label>
                <textarea id="description" class="form-control" name="description">{!! $description ?? '' !!}</textarea>
            </div>
        </div>

        <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
            <div class="form-group">
                <label for="name_en">@lang('admin.Title')</label>
                <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Title" value="{{ $name_en ?? '' }}">
            </div>
            <div class="form-group">
                <label for="description_en">@lang('admin.Description')</label>
                <textarea id="description_en" class="form-control" name="description_en">{!! $description_en ?? '' !!}</textarea>
            </div>
        </div>
    </div>

    {{-- Video --}}
    {{-- <div class="form-group">
        Video
        <input type="text" name="video_name" class="form-control" value="{{ $video_name ?? '' }}">
        <div class="inserIMG d-flex align-items-center">
            <input type="hidden" name="video" id="src-video" value="{{ $video ?? '' }}">
            @if (isset($video) && $video != '')
                <video height="240" controls>
                    <source src="{{ $slider->video }}">
                    Your browser does not support the video tag.
                </video>
            @else
                <img src="{{ asset('images/placeholder.png') }}" id="show-video" class="src-video ckfinder-popup" data-show="show-video" data="src-video" width="200">
            @endif

            <span class="remove-icon ml-3">
                <i class="fa-solid fa-xmark fa-lg"></i>
            </span>
        </div>
    </div> --}}

    <div class="form-group">
        <label for="sort">@lang('admin.Sort')</label>
        <input id="sort" type="text" name="sort" class="form-control" value="{{ $sort ?? 0 }}">
    </div>
</form>
