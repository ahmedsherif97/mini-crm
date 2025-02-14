@props([
    'label' => '',
    'class' => '',
    'name' => '',
    'value' => '',
    'type' => 'text',
    'placeholder' => '',
    'required',
    'hint' => '',
    'parentClass' => '',
    'onchange',
])
@php
    $required = isset($required) && $required == true;
@endphp

<div class="mb-3 form-check {{ $parentClass }}">

    <input type="{{ $type }}" class="form-check-input {{ $class }}" id="{{ $name }}Id"
        name="{{ $name }}" value="{{ $value ? $value : old($name) }}" placeholder="{!! $placeholder !!}"
        {{ $required ? 'required' : '' }}
        @isset($onchange) onchange="{{ $onchange }}" @endisset />
    <label class="form-check-label" for="{{ $name }}Id">
        {!! $label !!}
    </label>

    @if ($hint)
        <div class="form-text">{{ $hint }}</div>
    @endif
</div>

{{ $slot }}
