<button type="{{ $type }}"
    {{ $attributes->merge(['class' => "px-4 py-2 rounded text-white hover:opacity-90 transition
        bg-{$color}-600"]) }}>
    {{ $slot }}
</button>
