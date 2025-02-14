@extends('dashboard.layouts.master')

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? __('Customers')"></x-dashboard.breadcrumbs>
@endpush

@section('content')
    <h4 class="py-3 mb-2">{{ $title ?? __('Customers') }}</h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ __('Customers List') }}</h5>
            <a href="{{ route('dashboard.customers.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> {{ __('Add Customer') }}
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Assigned Employee') }}</th>
                    <th class="text-center">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>
                            @foreach ($customer->employees as $employee)
                                {{ $employee->user->name }}<br>
                            @endforeach
                        </td>
                        <td class="text-center d-flex justify-content-around">
                            @can('list employee')
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#reassignModal{{ $customer->id }}">
                                    <i class="bx bx-transfer"></i> {{ __('Reassign') }}
                                </button>
                            @endcan
                            @can('list customer')
                                <a href="{{ route('dashboard.customers.actions.index', $customer->id) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="bx bx-list-ul"></i> {{ __('Actions') }}
                                </a>
                            @endcan
                            <form action="{{ route('dashboard.customers.destroy', $customer->id) }}" method="POST"
                                  onsubmit="return confirm('{{ __('Are you sure you want to delete this customer?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bx bx-trash"></i> {{ __('Delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Reassign Modal -->
                    <div class="modal fade" id="reassignModal{{ $customer->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-3">
                                <div class="modal-body">
                                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    <h3 class="text-center mb-4">{{ __('Reassign Customer') }}</h3>
                                    <form action="{{ route('dashboard.customers.reassign', $customer->id) }}"
                                          method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Select Employee') }}</label>
                                            <select name="employee_id" class="form-control" required>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Reassign') }}
                                            </button>
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">
                                                {{ __('Cancel') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
