@props([
    'name' => '',
    'id',
    'multiple' => false,
    'required' => false,
    'message' => 'Select an option'
])

<select {!! $attributes->merge(['class' => 'form-select']) !!}
        data-control="select2" data-placeholder="{{ $message }}" name="{{ $name }}" {{ $multiple ? 'data-close-on-select=false' : '' }}
        id="{{ $id }}" {{ $required ? 'required' : '' }}
        {{ $multiple ? 'multiple="multiple"' : '' }}>
    {{ $slot }}
</select>
