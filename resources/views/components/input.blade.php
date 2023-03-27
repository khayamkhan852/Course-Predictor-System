@props([
    'disabled' => false,
    'type' => 'text',
])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'form-control']) !!}
    type="{{ $type }}"
/>
