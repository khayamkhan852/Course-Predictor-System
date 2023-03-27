@props([
    'name' => '',
    'id',
    'multiple' => false,
    'required' => false
])

<select {!! $attributes->merge(['class' => 'form-select']) !!}
        data-control="select2" data-placeholder="Select an option"
        name="{{ $name }}"
        {{ $multiple ? 'data-close-on-select=false' : '' }}
        id="{{ $id }}" {{ $required ? 'required' : '' }}
        {{ $multiple ? 'multiple="multiple"' : '' }}>
    {{ $slot }}
</select>
