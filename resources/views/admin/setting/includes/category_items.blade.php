@php
    if (!isset($parent_id)) {
        $parent_id = 0;
    }
    $categories = \App\Models\Category::where('parent', $parent_id)->where('type', $type)->orderByDesc('sort')->get();
@endphp
@if (count($categories) > 0)
    @foreach ($categories as $category)
        <div class="form-group">
            <label for="page_{{ $category->id }}" class="">
                <input type="checkbox" class="category_item_input" value="{{ $category->id }}" id="page_{{ $category->id }}">
                {{ $space ?? '' }} {{ $category->name }}
                <input type="hidden" class="item-name-{{ $category->id }}" value="{{ $category->name }}">
                @if ($type == 'post')
                    <input type="hidden" class="item-url-{{ $category->id }}" value="{{ route('news.category', $category->slug) }}">
                @else
                    <input type="hidden" class="item-url-{{ $category->id }}" value="{{ $category->slug . '.html' }}">
                @endif
                {{-- <input type="hidden" class="item-id-{{ $category->id }}" value="{{ $category->id }}"> --}}
                <input type="hidden" class="item-type-{{ $category->id }}" value="category">
            </label>
        </div>
        @if (count($category->children) > 0)
            @include('admin.setting.includes.category_items', ['parent_id' => $category->id, 'space' => '-----'])
        @endif
    @endforeach
@endif
