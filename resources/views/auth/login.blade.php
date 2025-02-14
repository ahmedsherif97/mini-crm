@extends('dashboard.layouts.auth')

@section('content')
    <h4 class="mb-2">{{ __('dashboard.Welcome to') }} {{ app('settings')->find('name') }}!</h4>
    <p class="mb-4">{{ __('dashboard.Please sign-in to your account and start the adventure') }}</p>

    <form id="formAuthentication" class="mb-3" action="{{ route('auth.login') }}" method="POST">
        @csrf

        <x-dashboard.forms.input type="email" name="email" label="{{ __('dashboard.Email or Username') }}"
            placeholder="{{ __('dashboard.Enter your email or username') }}" autofocus />

        <x-dashboard.forms.input type="password" name="password" label="{{ __('dashboard.password') }}"
            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" value="1" />
                <label class="form-check-label" for="remember-me">{{ __('dashboard.remember.me') }}</label>
            </div>
        </div>

        <input type="hidden" name="previous"
            value="{{ Request::has('previous') ? Request::get('previous') : URL::previous() }}">

        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">{{ __('dashboard.Please sign-in') }}</button>
        </div>
    </form>

    <p class="text-center">
        <span>{{ __('dashboard.Forgot Password?') }}</span>

        <a href="{{ route('auth.password.request') }}">
            <small>{{ __('dashboard.reset.password') }}</small>
        </a>
    </p>
@endsection
