@props([
    'label' => '',
    'class' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'hint' => '',
])


<div class="pt-4 text-center">
    <button type="submit" class="btn btn-primary me-sm-3 me-1">
        <span class="bx bx-save"></span>
        {{ __('dashboard.save') }}
    </button>
    <button type="reset" class="btn btn-label-secondary">
        <span class="bx bx-undo"></span>
        {{ __('dashboard.reset') }}
    </button>
    {{ $slot }}
</div>
