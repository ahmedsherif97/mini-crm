@props(['module', 'id' => null, 'delete' => true, 'edit' => true, 'view' => false])

<span class="text-nowrap">
    {!! $slot !!}

    @if ($edit)
        @can('update ' . $module)
            <a href="{{ route('dashboard.' . $module . '.edit', $id) }}" class="btn btn-sm btn-icon me-2"><i
                    class="bx bx-edit"></i></a>
        @endcan
    @endif

    @if ($delete)
        @can('delete ' . $module)
            <button data-href="{{ route('dashboard.' . $module . '.destroy', $id) }}" type="button"
                class="btn btn-sm btn-icon" data-bs-target="#confirmDeleteModal" data-bs-toggle="modal"
                data-bs-dismiss="modal"><i class="bx bx-trash"></i></button>
        @endcan
    @endif

</span>
