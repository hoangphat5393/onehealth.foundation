@php
    $data_type = $data_type ?? '';
    $parent = $parent ?? 0;
@endphp

@if ($data_type == '')
    @php
        $db = \App\Model\Category::where('status', 1)
            ->where('type', 'project')
            ->where('parent', 0);
        if (isset($id)) {
            $db->whereNot('id', $id);
        }
        $categories = $db->get();
    @endphp
    <select id="parent" class="custom-select mr-2" name="parent">
        <option value="0">== Không có ==</option>
        @if ($categories->count() > 0)
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $parent == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @if ($category->children('project')->get())
                    @include('admin.project-category.includes.select-category', [
                        'data' => $category->children('post')->whereNot('id', $id)->get(),
                        'data_type' => 'option',
                        'parent' => $parent,
                        'slit' => '-----',
                    ])
                @endif
            @endforeach
        @endif
    </select>
@else
    @foreach ($data as $item)
        <option value="{{ $item->id }}" {{ $parent == $item->id ? 'selected' : '' }}>{!! $slit !!} {{ $item->name }}</option>
        @if ($item->children('post')->get())
            @include('admin.project-category.includes.select-category', [
                'data' => $item->children('project')->whereNot('id', $id)->get(),
                'data_type' => 'option',
                'parent' => $parent,
                'slit' => $slit . '-----',
            ])
        @endif
    @endforeach
@endif
