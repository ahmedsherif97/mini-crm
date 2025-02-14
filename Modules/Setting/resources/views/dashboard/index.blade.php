@extends('dashboard.layouts.master')

@push('styles')
@endpush

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? ''">
    </x-dashboard.breadcrumbs>
@endpush

@section('content')
    <div class="row g-4">
        <div class="col-12 col-lg-4">
            <div class="d-flex justify-content-between flex-column mb-3 mb-md-0">
                <ul class="nav nav-align-left nav-pills flex-column" id="nav-tabs-1">
                    <li class="nav-item mb-1">
                        <a class="nav-link active" data-bs-toggle="pill" href="#home-tab">
                            <i class="bx bx-store me-2"></i>
                            <span class="align-middle">{{ __('dashboard.settings') . ' ' . __('dashboard.home') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-12 col-lg-8 pt-4 pt-lg-0">
            <div class="tab-content p-0">
                <div class="tab-pane fade show active" id="home-tab" role="tabpanel">
                    <form method="post" action="{{ route('dashboard.setting.store') }}" enctype="multipart/form-data">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title m-0">{{ __('dashboard.a settings') . ' ' . __('dashboard.site') }}
                                </h5>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row mb-3 g-3">
                                    <div class="col-sm-12">
                                        <x-dashboard.forms.input type="text" label="{{ __('dashboard.site.name') }}"
                                            name="name"
                                            value="{{ old('name', $settings->where('slug', 'name')->first()->value ?? '') }}"
                                            placeholder="{{ __('dashboard.Enter') . ' ' . __('dashboard.site.name') }}"
                                            required="true" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-dashboard.forms.input type="color" label="{{ __('dashboard.site.color') }}"
                                            name="primary-color"
                                            value="{{ old('primary-color', $settings->where('slug', 'primary-color')->first()->value ?? '') }}"
                                            placeholder="{{ __('dashboard.Enter') . ' ' . __('dashboard.site.color') }}"
                                            required="true" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-dashboard.forms.input type="color"
                                            label="{{ __('dashboard.site.secondary.color') }}" name="secondary-color"
                                            value="{{ old('secondary-color', $settings->where('slug', 'secondary-color')->first()->value ?? '') }}"
                                            placeholder="{{ __('dashboard.Enter') . ' ' . __('dashboard.site.secondary.color') }}"
                                            required="true" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-dashboard.forms.input type="file" label="{{ __('dashboard.logo') }}"
                                            name="logo"
                                            placeholder="{{ __('dashboard.Enter') }} {{ __('dashboard.logo') }}" />
                                        @if ($settings->where('slug', 'logo')->first())
                                            <div id="logo-preview" class="mt-2">
                                                <img src="{{ app('settings')->find('logo').'?v=5' }}"
                                                    class="img-fluid w-25" alt="">
                                                <button type="button" id="remove-logo"
                                                    class="btn btn-danger btn-sm mt-1">{{ __('dashboard.delete') }}</button>
                                            </div>
                                        @endif
                                        <input type="hidden" name="remove_logo" id="remove-logo-input" value="0">
                                    </div>
                                    <div class="col-sm-6">
                                        <x-dashboard.forms.input type="file" label="{{ __('dashboard.favicon') }}"
                                            name="favicon"
                                            placeholder="{{ __('dashboard.Enter') }} {{ __('dashboard.favicon') }}" />
                                        @if ($settings->where('slug', 'favicon')->first())
                                            <div id="favicon-preview" class="mt-2">
                                                <img src="{{ app('settings')->find('favicon') }}"
                                                    class="img-fluid" width="50px" alt="">
                                                <button type="button" id="remove-favicon"
                                                    class="btn btn-danger btn-sm mt-1">{{ __('dashboard.delete') }}</button>
                                            </div>
                                        @endif
                                        <input type="hidden" name="remove_favicon" id="remove-favicon-input"
                                            value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-3">
                            <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="financial-tab" role="tabpanel">
                    <form method="post" action="{{ route('dashboard.setting.financials') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title m-0">
                                    {{ __('dashboard.a settings') . ' ' . __('financial::dashboard.financials') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3 g-3">
                                    <div class="col-sm-6">
                                        <x-dashboard.forms.input type="text" label="{{ __('dashboard.currency') }}"
                                            name="currency"
                                            value="{{ old('currency', $settings->where('slug', 'currency')->first()->value ?? '') }}"
                                            placeholder="{{ __('dashboard.Enter') . ' ' . __('dashboard.currency') }}"
                                            required="true" />
                                        @error('currency')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <x-dashboard.forms.input type="text"
                                            label="{{ __('dashboard.currency symbol') }}" name="currency_symbol"
                                            value="{{ old('currency_symbol', $settings->where('slug', 'currency-symbol')->first()->value ?? '') }}"
                                            placeholder="{{ __('dashboard.Enter') . ' ' . __('dashboard.currency symbol') }}"
                                            required="true" :maxlength="5" />
                                        @error('currency_symbol')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-3">
                            <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="my-setting-tab" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0">{{ __('setting::dashboard.my settings') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3 g-3">
                                <div class="col-sm-6">
                                    <label class="form-label">
                                        {{ __('dashboard.a settings') . ' ' . __('dashboard.language') }}
                                    </label>
                                    <select class="form-select select2" id="language" name="language" required>
                                        <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>
                                            {{ __('dashboard.Arabic') }}
                                        </option>
                                        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>
                                            {{ __('dashboard.English') }}
                                        </option>
                                    </select>
                                    @error('language')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="site-setting-tab" role="tabpanel">
                    <form method="post" action="{{ route('dashboard.setting.siteSettings') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title m-0">{{ __('setting::dashboard.site-settings') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3 g-3">
                                    <div class="col-sm-6">
                                        <x-dashboard.forms.input type="text"
                                            label="{{ __('setting::dashboard.site-link') }}" name="site-link"
                                            value="{{ old('site-link', $settings->where('slug', 'site-link')->first()->value ?? '') }}"
                                            placeholder="{{ __('dashboard.Enter') . ' ' . __('dashboard.site-link') }}"
                                            required="true" />
                                        @error('site-link')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <x-dashboard.forms.input type="text"
                                            label="{{ __('setting::dashboard.site-phone') }}" name="site-phone"
                                            value="{{ old('site-phone', $settings->where('slug', 'site-phone')->first()->value ?? '') }}"
                                            placeholder="{{ __('dashboard.Enter') . ' ' . __('setting::dashboard.site-phone') }}"
                                            required="true" />
                                        @error('site-phone')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <x-dashboard.forms.input type="text"
                                            label="{{ __('setting::dashboard.site-email') }}" name="site-email"
                                            value="{{ old('site-email', $settings->where('slug', 'site-email')->first()->value ?? '') }}"
                                            placeholder="{{ __('dashboard.Enter') . ' ' . __('setting::dashboard.site-email') }}"
                                            required="true" />
                                        @error('site-email')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <x-dashboard.forms.input type="text"
                                            label="{{ __('setting::dashboard.site-address') }}" name="site-address"
                                            value="{{ old('site-address', $settings->where('slug', 'site-address')->first()->value ?? '') }}"
                                            placeholder="{{ __('dashboard.Enter') . ' ' . __('setting::dashboard.site-address') }}"
                                            required="true" />
                                        @error('site-address')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-3">
                            <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const removeLogoButton = document.getElementById('remove-logo');
            const removeLogoInput = document.getElementById('remove-logo-input');
            const logoPreview = document.getElementById('logo-preview');

            if (removeLogoButton) {
                removeLogoButton.addEventListener('click', function() {
                    logoPreview.style.display = 'none';
                    removeLogoInput.value = '1';
                });
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const removeFormButton = document.getElementById('remove-favicon');
            const removeFormInput = document.getElementById('remove-favicon-input');
            const faviconPreview = document.getElementById('favicon-preview');

            if (removeFormButton) {
                removeFormButton.addEventListener('click', function() {
                    faviconPreview.style.display = 'none';
                    removeFormInput.value = '1';
                });
            }
        });
        $(document).on('change', '#language', function() {
            let val = $(this).val();
            let url = "{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"; // Use a placeholder
            url = url.replace('ar', val);
            window.location.href = url;
        })
        $('#language').select2({
            allowClear: false
        });
    </script>
@endpush
