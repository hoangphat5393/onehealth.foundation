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

    <div class="col-lg-12 project mb-5">
        <div class="row g-0">
            <div class="col-lg-9">
                <img src="{{ get_image($item->image) }}" class="img-fluid w-100 project__img" alt="{{ $item->name }}">
            </div>
            <div class="col-lg-3">
                <div class="col-md-3 p-0">
                    <div class="donate_box">
                        <a href="{{ route('donate') }}">TÀI TRỢ <br> DỰ ÁN NÀY</a>
                    </div>
                    <div class="read_more_box">
                        <a href="{{ route('campaign.detail', [$item->slug, $item->id]) }}">Đọc thêm &gt;&gt;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 ">
                <h3 class="d-flex align-items-center"><a href="{{ route('campaign.detail', [$item->slug, $item->id]) }}" class="custom">{{ $item->name }}</a></h3>
            </div>
            <div class="col-lg-12">
                <div class="project__desc">
                    {!! htmlspecialchars_decode($item->description) !!}
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>
@endempty