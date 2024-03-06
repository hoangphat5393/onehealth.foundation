@php
//$parent_id = $parent_id ?? 0;
//$dategories = \App\Model\ShopCategory::where('parent', $parent_id)->orderByDesc('preority')->get();
@endphp

@if (count($categories) > 0)
@foreach ($categories as $data)
<tr class="tr-item item-level-{{ isset($level) ? $level : 0 }}">
    <td class="text-center"><input type="checkbox" id="{{ $data->id }}" name="seq_list[]" value="{{ $data->id }}"></td>
    <td class="text-center stt">{{ $data->sort }}</td>
    <td class="title">
        <a class="row-title " href="{{ route('admin.categoryProductDetail', [$data->id]) }}">
            <div><b style='color: #056FAD;'>{{ $data->name }}</b></div>
        </a>

    </td>
    <td class="text-center">
        @if ($data->image != null)
        <img src="{{ get_image($data->icon) }}" style="height: 70px">
        @endif
    </td>
    <td class="text-center">
        {{ $data->updated_at }}
        <br>
        @if ($data->status == 1)
        <span class="badge badge-primary">Public</span>
        @else
        <span class="badge badge-secondary">Draft</span>
        @endif
    </td>
</tr>
@if (count($data->children('product')->get()) > 0)
@include('admin.post-category.includes.category_item', [
'categories' => $data->children,
'level' => $level + 1,
])
@endif
@endforeach
@endif