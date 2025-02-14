@extends('dashboard.layouts.master')

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? __('Employees')"></x-dashboard.breadcrumbs>
@endpush

@section('content')
    <h4 class="py-3 mb-2">{{ $title ?? __('Employees') }}</h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ __('Employees List') }}</h5>
            <a href="{{ route('dashboard.employees.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> {{ __('Add Employee') }}
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
                    <th class="text-center">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->user->name }}</td>
                        <td>{{ $employee->user->email }}</td>
                        <td>{{ $employee->user->phone ?? '-' }}</td>
                        <td class="text-center">
                            <form action="{{ route('dashboard.employees.destroy', $employee->id) }}" method="POST"
                                  onsubmit="return confirm('{{ __('Are you sure you want to delete this employee?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bx bx-trash"></i> {{ __('Delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
