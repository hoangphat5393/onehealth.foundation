@php
    if (isset($slider)) {
        extract($slider->toArray());
    }
@endphp

<form id="form-editSlider" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="{{ $id ?? 0 }}">
    <input type="hidden" name="slider_id" value="{{ $parent ?? 0 }}">
    <div class="form-group">
        <label for="sub_name">Tên phụ</label>
        <input type="text" class="form-control" id="sub_name" name="sub_name" value="{{ $sub_name ?? '' }}">
    </div>
    <div class="form-group">
        <label for="name">Tên</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $name ?? '' }}">
    </div>
    <div class="form-group">
        <label for="link">Đường dẫn</label>
        <input type="text" class="form-control" name="link" value="{{ $link ?? '' }}">
    </div>
    <div class="form-group">
        <label for="link">Tên đường dẫn</label>
        <input type="text" class="form-control" name="link_name" value="{{ $link_name ?? '' }}">
    </div>
    <div class="form-group">
        <label for="sort">Thứ tự</label>
        <input id="sort" type="text" name="sort" class="form-control" value="{{ $sort ?? 0 }}">
    </div>
    <div class="form-group">
        Ảnh
        <div class="inserIMG">
            <input type="hidden" name="image" id="src-img" value="{{ $image ?? '' }}">
            @if (isset($src) && $src != '')
                <img src="{{ get_image($slider->image) }}" id="show-img" class="show-img src-img ckfinder-popup" data-show="show-img" data="src-img" width="200" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.png') }}';">
            @else
                <img src="{{ asset('images/placeholder.png') }}" id="show-img" class="src-img ckfinder-popup" data-show="show-img" data="src-img" width="200">
            @endif
            <span class="remove-icon ml-3">
                <i class="fa-solid fa-xmark fa-lg"></i>
            </span>
        </div>
    </div>

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
        <textarea name="description" id="description" class="form-control">{!! $description ?? '' !!}</textarea>
    </div>
</form>
