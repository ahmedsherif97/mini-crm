@props([
    'title' => '',
])


<h4 class="py-3 mb-2">
    <span class="text-muted fw-light">
        <i class="bx bx-home-circle"></i>
        {{ __('dashboard.dashboard') }} / </span>

    {!! $slot !!}

    {{ $title ?? '' }}
</h4>
