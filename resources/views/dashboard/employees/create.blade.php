@extends('dashboard.layouts.master')

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? __('Add Employee')"></x-dashboard.breadcrumbs>
@endpush

@section('content')
    <h4 class="py-3 mb-2">{{ $title ?? __('Add Employee') }}</h4>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">{{ __('Enter employee details') }}</h5>

            <form action="{{ route('dashboard.employees.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('Phone') }}</label>
                    <input type="text" name="phone" id="phone" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-user-plus"></i> {{ __('Add Employee') }}
                    </button>
                    <a href="{{ route('dashboard.employees.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
