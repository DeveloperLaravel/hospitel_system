@foreach(config('menu') as $item)
    @if(!$item['permission'] || auth()->user()->can($item['permission']))
        <x-nav-link :route="$item['route']" :icon="$item['icon']" :label="$item['label']"/>
    @endif
@endforeach
{{-- <a href="{{ $href }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-100">
    @if($icon)
        <span class="mr-2">{{ $icon }}</span>
    @endif
    {{ $slot }}
</a> --}}
