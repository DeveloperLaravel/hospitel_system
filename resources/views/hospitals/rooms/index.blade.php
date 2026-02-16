<x-app-layout title="Rooms">

    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Rooms</h1>
        @role('admin')
            <a href="{{ route('rooms.create') }}" class="bg-blue-600 text-white">
                + Add Room
            </a>
        @endrole
    </div>

    @if(session('success'))
        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <x-table>
            <tr>
                <th>#</th>
                <th>Room Number</th>
                <th>Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            @forelse($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->room_number }}</td>
                    <td>{{ ucfirst($room->type) }}</td>
                    <td>
                        <span class="{{ $room->status == 'available' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($room->status) }}
                        </span>
                    </td>
                    <td class="space-x-2">
                        <a href="{{ route('rooms.show', $room) }}" class="bg-green-400 text-white">View</a>
                        @role('admin')
                            <a href="{{ route('rooms.edit', $room) }}" class="bg-yellow-400 text-white">Edit</a>
                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <x-button class="bg-red-500 text-white">Delete</x-button>
                            </form>
                        @endrole
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4">No rooms found.</td>
                </tr>
            @endforelse
    </x-table>

    <div class="mt-4">
        {{ $rooms->links() }}
    </div>

</x-app-layout>
