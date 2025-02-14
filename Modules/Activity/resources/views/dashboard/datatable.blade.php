@foreach ($result as $index => $row)
    <tr>
        <td data-column="id">{{ $row->id }}</td>
        <td data-column="user">{{ $row->user ?? '' }}</td>
        <td data-column="message">{{ $row->message ?? '' }}</td>
        <td data-column="actions">
            <x-dashboard.table.actions module='activity' id='{{ $row->id }}' :edit="false" />
        </td>
    </tr>
@endforeach
