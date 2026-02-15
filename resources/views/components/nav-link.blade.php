@props(['route', 'icon', 'label'])

<a href="{{ route($route) }}"
   class="flex items-center gap-3 p-2 rounded-lg
          hover:bg-red-100 dark:hover:bg-gray-700
          transition transform hover:scale-[1.02]
          {{ request()->routeIs($route . '*') ? 'bg-red-100 dark:bg-gray-700' : '' }}">
    {{ $icon }}
    <span>{{ $label }}</span>
</a>
