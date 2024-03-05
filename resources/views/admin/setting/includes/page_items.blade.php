@php
    $pages = \App\Models\Page::where('status', 1)
        // ->orderByDesc('id')
        ->orderBy('sort')
        ->get();
@endphp
@if (count($pages) > 0)
    @foreach ($pages as $page)
        <div class="form-group">
            <label for="category_{{ $page->id }}" class="">
                <input type="checkbox" class="category_item_input" value="{{ $page->id }}" id="category_{{ $page->id }}">
                {{ $page->title }}
                <input type="hidden" class="item-name-{{ $page->id }}" value="{{ $page->title }}">
                <input type="hidden" class="item-url-{{ $page->id }}" value="{{ route('page', $page->slug) }}">
                <input type="hidden" class="item-id-{{ $page->id }}" value="{{ $page->id }}">
                <input type="hidden" class="item-type-{{ $page->id }}" value="page">
            </label>
        </div>
    @endforeach
@endif
