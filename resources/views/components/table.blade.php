<div class="overflow-x-auto bg-white shadow rounded">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                @foreach($headers as $header)
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            {{ $slot }}
        </tbody>
    </table>
</div>
