@props(['type' => 'text', 'name', 'value' => '', 'placeholder' => ''])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge([
        'class' => 'border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-md shadow-sm w-full p-2'
    ]) }}
/>
