@props([
    'label' => '',
    'class' => '',
    'name' => '',
    'value' => '',
    'type' => 'text',
    'placeholder' => '',
    'required',
    'hint' => '',
    'max' => '',
    'min' => '',
    'parentClass' => '',
    'onchange',
])
@php
    $required = isset($required);
@endphp

@if ($type == 'textarea')
    <div class="mb-3 {{ $parentClass }}">
        <label class="form-label">
            {!! $label !!}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
        <textarea class="form-control {{ $class }}" name="{{ $name }}" placeholder="{!! $placeholder !!}"
                  {{ $required ? 'required' : '' }} @isset($onchange) onchange="{{ $onchange }}" @endisset>{{ $value ? $value : old($name) }}</textarea>

        @if ($hint)
            <div class="form-text">{{ $hint }}</div>
        @endif
    </div>

@elseif ($type == 'password')
    <div class="mb-3 form-password-toggle">
        <label class="form-label">
            {!! $label !!}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
        <div class="input-group input-group-merge">
            <input type="{{ $type }}" class="form-control {{ $class }}" name="{{ $name }}"
                   value="{{ $value ? $value : old($name) }}" placeholder="{!! $placeholder !!}"
                   {{ $required ? 'required' : '' }}
                   @isset($onchange) onchange="{{ $onchange }}" @endisset />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
    </div>
@else
    <div class="mb-3 {{ $parentClass }}">
        <label class="form-label">
            {!! $label !!}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
        <input type="{{ $type }}" class="form-control {{ $class }}" name="{{ $name }}"
               value="{{ $value ? $value : old($name) }}" placeholder="{!! $placeholder !!}"
               {{ $required ? 'required' : '' }}
               {{$type == 'number' ? 'min='.$min.' max='.$max.' ' : ''}}

               @isset($onchange) onchange="{{ $onchange }}" @endisset />

        @if ($hint)
            <div class="form-text">{{ $hint }}</div>
        @endif
    </div>
@endif





{{ $slot }}
