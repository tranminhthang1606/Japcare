@foreach ($children as $sub)
    <option value="{{ $sub->id }}" data-parent="{{ $sub->id }}"
        {{ (isset($id_current) && $id_current == $sub->id ? 'disabled' : '') }}
        {{(old('category_id') == $sub->id || old('parent_id') == $sub->id) ? 'selected' : (isset($id_selected) && $id_selected == $sub->id ? 'selected' : '')}}
    >
        {{ $parent}} {{ $sub->title }}
    </option>

    @if (count($sub->children) > 0)
        @php
            $arrChildren = ['children' => $sub->children, 'parent' => $parent.'-'];
            if (isset($id_selected)) $arrChildren['id_selected'] = $id_selected;
            if (isset($id_current)) $arrChildren['id_current'] = $id_current;
        @endphp
        @include('admins.inc.subcategories', $arrChildren)
    @endif
@endforeach
