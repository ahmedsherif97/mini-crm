@props([
    'id' => '',
    'label' => '',
    'class' => '',
    'name' => '',
    'value' => '',
    'type' => 'text',
    'placeholder' => '',
    'required',
    'multiple',
    'hint' => '',
    'parentClass' => '',
    'options' => [],
    'onchange',
])
@php
    $required = isset($required);
    $multiple = isset($multiple);
@endphp

<div class="mb-3 {{ $parentClass }}">
    <label class="form-label">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <select class="form-select select2 {{ $class }}"
        @if ($id) id="{{ $id }}" @endif name="{{ $name }}"
        placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{ $multiple ? 'multiple' : '' }}
        @isset($onchange) onchange="{{ $onchange }}" @endisset>
        @foreach ($options ?? [] as $key => $text)
            <option value="{{ $key }}" {{ $key == $value ? 'selected' : '' }}>{{ $text }}</option>
        @endforeach
        {{ $slot }}
    </select>

    @if ($hint)
        <div class="form-text">{{ $hint }}</div>
    @endif
</div>
