@props([
    'id' => '',
    'value' => 'on',
    'name' => '',
    'isChecked' => '0'
])


<input {{ $attributes->merge(['class' => 'form-check-input']) }}
       name="{{ $name }}" type="checkbox" value="{{ $value }}" id="{{ $id }}" {{ $isChecked ? 'checked' : '' }} />
<label class="form-check-label" for="{{ $id }}">
    {{ $slot }}
</label>

