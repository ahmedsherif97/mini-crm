@foreach ($result as $index => $row)
    <tr>
        <td data-column="id">{{ $row->id }}</td>
        <td data-column="slug">{{ $row->slug }}</td>
        <td data-column="type">{{ $row->type }}</td>
        <td data-column="value">
            @if ($row->type == 'image')
                <img src="{{ $row->value }}" height="30" />
            @elseif($row->type == 'video')

            @elseif($row->type == 'html')
            @else
                {{ $row->value }}
            @endif
        </td>
        <td data-column="actions">
            <x-dashboard.table.actions module='setting' id='{{ $row->id }}' />
        </td>
    </tr>
@endforeach
