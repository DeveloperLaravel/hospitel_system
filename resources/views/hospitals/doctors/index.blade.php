<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-100">
                Doctors
            </h2>
            {{-- @can('doctors.create') --}}
                <a href="{{ route('doctors.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    + Add Doctor
                </a>
            {{-- @endcan --}}
        </div>
    </x-slot>

    <div class="py-4 space-y-4">

        <!-- Flash Message -->
        @if(session('success'))
            <div class="p-3 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Doctors Table -->
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Department</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Specialization</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Phone</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">License</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($doctors as $doctor)
                        <tr>
                            <td class="px-4 py-2">{{ $doctor->id }}</td>
                            <td class="px-4 py-2">{{ $doctor->name }}</td>
                            <td class="px-4 py-2">{{ $doctor->department->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $doctor->specialization }}</td>
                            <td class="px-4 py-2">{{ $doctor->phone }}</td>
                            <td class="px-4 py-2">{{ $doctor->license_number }}</td>
                            <td class="px-4 py-2 flex space-x-2">
                                @can('doctors.edit')
                                    <a href="{{ route('doctors.edit', $doctor) }}"
                                       class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 transition">
                                        Edit
                                    </a>
                                @endcan
                                {{-- @can('doctors.delete') --}}
                                    <form action="{{ route('doctors.destroy', $doctor) }}" method="POST"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                            Delete
                                        </button>
                                    </form>
                                {{-- @endcan --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">No doctors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $doctors->links() }}
        </div>

    </div>
</x-app-layout>
