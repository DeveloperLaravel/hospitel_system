<x-app-layout title="Nurses">

    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Nurses</h1>
        @role('admin')
            <a href="{{ route('nurses.create') }}" class="bg-blue-600 text-white">
                + Add Nurse
            </a>
        @endrole
    </div>

    @if(session('success'))
        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <x-table>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>

            @forelse($nurses as $nurse)
                <tr>
                    <td>{{ $nurse->id }}</td>
                    <td>{{ $nurse->name }}</td>
                    <td>{{ $nurse->phone ?? '-' }}</td>
                    <td>{{ $nurse->department->name }}</td>
                    <td class="space-x-2">
                        <a href="{{ route('nurses.show', $nurse) }}" class="bg-green-400 text-white">View</a>
                        @role('admin')
                            <a href="{{ route('nurses.edit', $nurse) }}" class="bg-yellow-400 text-white">Edit</a>
                            <form action="{{ route('nurses.destroy', $nurse) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <x-button class="bg-red-500 text-white">Delete</x-button>
                            </form>
                        @endrole
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4">No nurses found.</td>
                </tr>
            @endforelse
    </x-table>

    <div class="mt-4">
        {{ $nurses->links() }}
    </div>

</x-app-layout>
