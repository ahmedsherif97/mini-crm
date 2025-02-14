@extends('dashboard.layouts.master')

@push('styles')
@endpush

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? ''">
        <x-dashboard.breadcrumbs-item :href="route('dashboard.setting.index')">
            {{ __('setting::dashboard.settings') }}
        </x-dashboard.breadcrumbs-item>
    </x-dashboard.breadcrumbs>
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $title ?? '' }}</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.setting.store') }}">
                @csrf
                @includeIf('setting::dashboard.form')
                <x-dashboard.forms.save />
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
