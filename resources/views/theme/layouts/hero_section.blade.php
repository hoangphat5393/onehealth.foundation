@php
    $slider_main = \App\Models\Slider::where('status', 0)
        ->where('slider_id', 42)
        ->orderBy('sort', 'asc')
        ->get();
@endphp

@empty(!$slider_main)
    <div class="container-fluid px-0">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @for ($i = 0; $i < $slider_main->count(); $i++)
                    <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="{{ $i }}" @class(['active' => $i == 0]) aria-current="true" aria-label="Slide {{ $i }}"></button>
                @endfor
            </div>
            <div class="carousel-inner">
                @php $i = 0;@endphp
                @foreach ($slider_main as $item)
                    <div @class(['carousel-item', 'active' => $i == 0])>
                        <img class="w-100" src="{{ get_image($item->src) }}" alt="Image" />
                        <div class="carousel-caption d-none">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-7">
                                        {!! htmlspecialchars_decode($item->description) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $i++;@endphp
                @endforeach
            </div>
        </div>
    </div>
@endempty

@push('scripts')
    {{-- <script type="text/javascript"></script> --}}
@endpush
