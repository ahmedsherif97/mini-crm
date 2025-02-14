@extends('dashboard.layouts.master')

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? __('Add Customer')"></x-dashboard.breadcrumbs>
@endpush

@section('content')
    <h4 class="py-3 mb-2">{{ $title ?? __('Add Customer') }}</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('dashboard.customers.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">{{ __('Name') }}</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Email') }}</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Phone') }}</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                @can('list employee')
                    <div class="mb-3">
                        <label class="form-label">{{ __('Assign to Employee') }}</label>
                        <select name="employee_id" class="form-control" required>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endcan

                <button type="submit" class="btn btn-primary">{{ __('Add Customer') }}</button>
            </form>
        </div>
    </div>
@endsection
