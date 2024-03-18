@php
    $level = $level ?? 0;
    if ($level == 0) {
        $categories = App\Models\Category::where('parent', 0)->where('type', $category_type)->orderByDesc('sort')->get();
    }
@endphp

<ul id="muti_menu_post" class="muti_menu_right_category">
    @foreach ($categories as $category)
        @php
            $checked = '';
            if (in_array($category->id, $array_checked)) {
                $checked = 'checked';
            }
        @endphp
        <li class="category_menu_list">
            <label for="checkbox_cmc_{{ $category->id }}">
                <input type="checkbox" class="category_item_input" name="category_id[]" value="{{ $category->id }}" id="checkbox_cmc_{{ $category->id }}" {{ $checked }}>
                <span>{{ $category->name }} | {{ $category->name_en }}</span>
            </label>
            @if ($category->children($category_type)->get())
                @include('admin.partials.category-item', [
                    'categories' => $category->children($category_type)->get(),
                    'level' => $level + 1,
                ])
            @endif
        </li>
    @endforeach
</ul>
