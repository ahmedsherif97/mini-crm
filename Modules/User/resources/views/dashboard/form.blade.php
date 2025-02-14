<div class="row g-3">
    <div class="col-sm-6">
        <x-dashboard.forms.input type="text" label="{{__('dashboard.name')}}" name="name"
            value="{{ request('name', $user->name ?? '') }}" placeholder="{{__('api.enter.message')}} {{__('dashboard.name')}}" required="true" />
    </div>
    <div class="col-sm-6">
        <x-dashboard.forms.input type="email" label="{{__('dashboard.email')}}" name="email" placeholder="{{__('dashboard.Enter')}} {{__('dashboard.email')}}" required="true"
            hint="Email is unique" value="{{ request('email', $user->email ?? '') }}" />
    </div>
</div>

@if (!isset($user))
    <div class="row g-3">
        <div class="col-sm-6">
            <x-dashboard.forms.input type="password" label="{{__('dashboard.password')}}" name="password" placeholder="{{__('dashboard.Enter')}} {{__('dashboard.password')}}"
                required="true" />
        </div>
    </div>
@endif
