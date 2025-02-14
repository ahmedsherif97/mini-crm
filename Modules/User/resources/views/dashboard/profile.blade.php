@extends('dashboard.layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/pages/page-profile.css"/>
@endpush

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? ''">
        <x-dashboard.breadcrumbs-item :href="route('dashboard.user.index')">
            {{ __('user::dashboard.users') }}
        </x-dashboard.breadcrumbs-item>
    </x-dashboard.breadcrumbs>
@endpush

@section('content')
    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="{{ asset('assets') }}/img/pages/profile-banner.png" alt="Banner image"
                         class="rounded-top"/>
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="{{ asset($user->avatar) }}" alt="user image"
                             class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img"/>
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>{{ $user->name ?? '' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $title ?? '' }}</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.user.profile.update') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-sm-6">
                        <x-dashboard.forms.input type="text" label="{{__('dashboard.name')}}" name="name"
                                                 value="{{ old('name', auth()->user()->name ?? '') }}"
                                                 placeholder="{{__('dashboard.Enter').' '.__('dashboard.name')}}"
                                                 required="true"/>
                    </div>
                    <div class="col-sm-6">
                        <x-dashboard.forms.input type="email" label="{{__('dashboard.email')}}" name="email"
                                                 value="{{ old('email', auth()->user()->email ?? '') }}"
                                                 placeholder="{{__('dashboard.Enter').' '.__('dashboard.email')}}"
                                                 required="true"/>
                    </div>

                    <div class="col-sm-6">
                        <x-dashboard.forms.input type="phone" label="{{__('dashboard.phone')}}" name="phone"
                                                 value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                                 placeholder="{{__('dashboard.Enter').' '.__('dashboard.phone')}}"
                        />
                    </div>

                    <x-dashboard.forms.save/>
                </div>
            </form>
        </div>
    </div>
@endsection
