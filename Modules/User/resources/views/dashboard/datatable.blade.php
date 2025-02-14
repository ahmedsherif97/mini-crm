@foreach ($result as $row)
    <tr>
        <td data-column="id">{{ $row->id ?? '' }}</td>
        <td data-column="name">
            <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                    <div class="avatar avatar-sm me-3">
                        <img src="{{ asset($row->avatar) }}" alt="{{ $row->name ?? '' }}" class="rounded-circle">
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <a href="{{ route('dashboard.user.show', $row->id) }}" class="text-body text-truncate">
                        <span class="fw-medium">
                            {{ $row->name ?? '' }}
                        </span>
                    </a>
                    <small class="text-muted">
                        {{ $row->email ?? '' }}
                    </small>
                </div>
            </div>
        </td>
        <td data-column="email">{{ $row->email ?? '' }}</td>
        <td data-column="actions">
            <x-dashboard.table.actions module='user' id='{{ $row->id }}'/>
        </td>
    </tr>
@endforeach
