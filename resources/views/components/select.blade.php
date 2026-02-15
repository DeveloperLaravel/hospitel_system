@props(['name', 'options' => [], 'selected' => null])

<select name="{{ $name }}" {{ $attributes->merge(['class' => 'border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-md shadow-sm w-full p-2']) }}>
    @foreach($options as $value => $label)
        <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
