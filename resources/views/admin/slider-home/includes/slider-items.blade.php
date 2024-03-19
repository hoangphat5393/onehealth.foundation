@foreach ($sliders as $slider)
    <div class="slider-item slider-{{ $slider->id }} row mb-2 pb-2 border-bottom align-items-center">
        <input type="hidden" name="slider[]" value="{{ $slider->id }}">
        <div class="col-lg-3 d-flex align-items-center">
            <i class="fa fa-sort"></i>&emsp;
            <div>
                <img src="{{ get_image($slider->image) }}" class="img-fluid d-block mx-auto" style="min-height: 85px">
            </div>
        </div>
        <div class="col-lg-3">
            {{-- {{ $slider->sub_name }}
            <br> --}}
            {{ $slider->name }} | {{ $slider->name_en }}
        </div>

        <div class="col-lg-3">
            {{ $slider->link_name }}
            <br>
            <a href="{{ $slider->link }}">{{ $slider->link }}</a>
        </div>
        <div class="col-md-3 d-flex justify-content-center">
            <button type="button" class="btn btn-sm btn-info edit-slider" data="{{ $slider->id }}" data-parent="{{ $slider->slider_id }}">@lang('admin.Edit')</button>
            <button type="button" class="btn btn-sm btn-danger delete-slider ml-2" data="{{ $slider->id }}">@lang('admin.Delete')</button>
        </div>
    </div>
@endforeach
