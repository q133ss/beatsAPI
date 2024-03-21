@foreach($children as $child)
    <tr>
        <td>{{$child->id}}</td>
        <td><span class="ms-2">{{$child->name}}</span></td>
        <td>{{$child->getParent->name}}</td>
        <td>
            <a href="{{route('category.edit', $child->id)}}">Изменить</a>
            <form action="{{route('category.destroy', $child->id)}}" style="display: inline-block" method="POST">
                @csrf
                @method("DELETE")
                <button type="submit" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" style="color: #ff0000" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0"/><path d="M10 11l0 6"/><path d="M14 11l0 6"/><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/></svg>
                </button>
            </form>
        </td>
    </tr>
    <!-- Рекурсивный вызов для вывода вложенных категорий -->
    @include('category.child', ['children' => $child->getChildren])
@endforeach
