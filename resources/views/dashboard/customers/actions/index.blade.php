@extends('dashboard.layouts.master')

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="__('Actions for ') . $customer->name"></x-dashboard.breadcrumbs>
@endpush

@section('content')
    <h4 class="py-3 mb-2">{{ __('Actions for ') . $customer->name }}</h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ __('Action List') }}</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addActionModal">
                <i class="bx bx-plus"></i> {{ __('Add Action') }}
            </button>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th>{{ __('Employee') }}</th>
                    <th>{{ __('Customer') }}</th>
                    <th>{{ __('Action Type') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Result') }}</th>
                    <th>{{ __('Edit') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($actions as $action)
                    <tr>
                        <td>
                            {{ $action->employee_id === auth()->user()->employee?->id ? __('You') : ($action->employee? $action->employee->user->name : 'System Admin') }}
                        </td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ ucfirst($action->action_type) }}</td>
                        <td>{{ $action->action_date }}</td>
                        <td>
                            {{ $action->result ?? '-' }}
                        </td>
                        <td>
                            @if ($action->employee_id === auth()->user()->employee?->id || !auth()->user()->hasRole('Employee'))
                                <button class="btn btn-sm btn-warning edit-action" data-id="{{ $action->id }}"
                                        data-result="{{ $action->result }}">
                                    <i class="bx bx-edit"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Action Modal -->
    <div class="modal fade" id="addActionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-body">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal"></button>
                    <h3 class="text-center mb-4">{{ __('Add New Action') }}</h3>
                    <form action="{{ route('dashboard.customers.actions.store', $customer->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{ __('Action Type') }}</label>
                            <select name="action_type" class="form-control" required>
                                <option value="call">{{ __('Call') }}</option>
                                <option value="visit">{{ __('Visit') }}</option>
                                <option value="follow_up">{{ __('Follow-up') }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Date') }}</label>
                            <input type="datetime-local" name="action_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Result') }}</label>
                            <textarea name="result" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Add Action') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Action Result Modal -->
    <div class="modal fade" id="editActionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-body">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal"></button>
                    <h3 class="text-center mb-4">{{ __('Edit Action Result') }}</h3>
                    <form id="editActionForm">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" id="editActionId">
                        <div class="mb-3">
                            <label class="form-label">{{ __('Result') }}</label>
                            <textarea id="editActionNotes" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Update Result') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $('.edit-action').on('click', function () {
            $('#editActionId').val($(this).data('id'));
            $('#editActionNotes').val($(this).data('result'));
            $('#editActionModal').modal('show');
        });

        $('#editActionForm').on('submit', function (e) {
            e.preventDefault();
            let id = $('#editActionId').val();
            let url = "{{route('dashboard.actions.update-result', 'id')}}"
            url = url.replace('id', id);
            $.ajax({
                url: url,
                type: 'PATCH',
                data: {_token: '{{ csrf_token() }}', result: $('#editActionNotes').val()},
                success: function () {
                    location.reload();
                }
            });
        });
    </script>
@endpush
