@php extract($data) @endphp
@php

    use Carbon\Carbon;
    Carbon::setLocale('vi');

    $project = \App\Models\Campaign::limit($items)->get();

@endphp
@empty(!$project)
    <div class="container">
        <div class="row">
            @foreach ($project as $item)
                @php
                    $cdt = new Carbon($item->created_at);
                @endphp

                {{-- <div class="datetime text-end my-3">
                    <span>{{ $cdt->format('d-m-Y') }}</span>
                </div> --}}

                <div class="col-lg-12">
                    <div class="row project g-0 mb-5">
                        <div class="col-lg-12">
                            <img src="{{ get_image($item->image) }}" class="img-fluid project__img" alt="{{ $item->name }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10">
                            <h3>
                                <a href="{{ route('campaign.detail', [$item->slug, $item->id]) }}" class="custom">{{ $item->name }}</a>
                            </h3>
                            <div>
                                {!! htmlspecialchars_decode($item->description) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endempty
