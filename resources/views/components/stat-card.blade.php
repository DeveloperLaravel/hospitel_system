@props(['title', 'value', 'icon'])

<div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow
            hover:shadow-xl transition">

    <div class="flex justify-between">
        <div>
            <p class="text-gray-500">{{ $title }}</p>
            <h2 class="text-2xl font-bold mt-2">{{ $value }}</h2>
        </div>

        <div class="text-3xl">
            {{ $icon }}
        </div>
    </div>

</div>
