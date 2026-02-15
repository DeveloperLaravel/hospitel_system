<x-app-layout title="Lab Tests">

<div class="flex justify-between mb-4">
    <h2 class="text-2xl font-bold">Lab Tests</h2>

    @can('labtest.create')
        <x-link href="{{ route('lab_tests.create') }}" class="bg-blue-600 text-white">
            + New Test
        </x-link>
    @endcan
</div>

@if(session('success'))
    <div class="bg-green-200 text-green-800 p-2 rounded mb-3">
        {{ session('success') }}
    </div>
@endif

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-100">
        <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Test</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($labTests as $test)
        <tr class="border-b">
            <td>{{ $test->id }}</td>
            <td>{{ $test->patient->name }}</td>
            <td>{{ $test->doctor->name }}</td>
            <td>{{ $test->test_name }}</td>
            <td>
                <span class="{{ $test->status == 'completed' ? 'text-green-600' : 'text-yellow-600' }}">
                    {{ ucfirst($test->status) }}
                </span>
            </td>
            <td class="space-x-1">

                <x-link href="{{ route('lab_tests.show',$test) }}" class="bg-green-500 text-white">View</x-link>

                @can('labtest.edit')
                <x-link href="{{ route('lab_tests.edit',$test) }}" class="bg-yellow-500 text-white">Edit</x-link>
                @endcan

                @can('labtest.complete')
                    @if($test->status == 'pending')
                    <form action="{{ route('lab_tests.complete',$test) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <x-button class="bg-indigo-600 text-white">
                            Complete
                        </x-button>
                    </form>
                    @endif
                @endcan

                @can('labtest.delete')
                <form action="{{ route('lab_tests.destroy',$test) }}" method="POST" class="inline"
                      onsubmit="return confirm('Delete?')">
                    @csrf
                    @method('DELETE')
                    <x-button class="bg-red-600 text-white">
                        Delete
                    </x-button>
                </form>
                @endcan

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $labTests->links() }}
</div>

</x-app-layout>
