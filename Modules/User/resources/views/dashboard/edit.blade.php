@extends('dashboard.layouts.master')

@push('styles')
@endpush

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? ''">
        <x-dashboard.breadcrumbs-item :href="route('dashboard.user.index')">
            {{ __('user::dashboard.users') }}
        </x-dashboard.breadcrumbs-item>
    </x-dashboard.breadcrumbs>
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $title ?? '' }}</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.user.update', $user->id) }}">
                @csrf
                @method('PUT')
                @includeIf('user::dashboard.form')
                <x-dashboard.forms.save />
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
