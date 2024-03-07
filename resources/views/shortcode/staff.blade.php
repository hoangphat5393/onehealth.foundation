@php extract($data) @endphp
@php
    // $sliders = \App\Models\Slider::where('slider_id', $id)->get();
    $sliders = \App\Models\Slider::where('id', $id)->first();
@endphp
@empty(!$sliders)
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <h3 class="text-center fs-1">
                    {{ $sliders->name }}
                </h3>
            </div>
            @foreach ($sliders->children as $item)
                <div class="col-md-4">
                    {{-- <div class="item-product">
                         <div class="product-img">
                            <img src="{{ get_image($item->image) }}" class="border border-5 border-white rounded-2" alt="Bộ sách luyện thi IELTS cho người mới bắt đầu">
                        </div>
                    </div> --}}
                    <img class="img-fluid w-100 mb-3" src="{{ get_image($item->image) }}" alt="{{ $item->name }}">
                    <div>
                        {!! htmlspecialchars_decode($item->description) !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endempty
