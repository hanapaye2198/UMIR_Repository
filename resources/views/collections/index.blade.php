<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Collections</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <a href="{{ route('collections.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">+ Add Collection</a>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow rounded">
            <table class="w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Community</th>
                        <th class="px-4 py-2 text-left">Description</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collections as $collection)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $collection->name }}</td>
                            <td class="px-4 py-2">{{ $collection->community->name }}</td>
                            <td class="px-4 py-2">{{ $collection->description }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('collections.edit', $collection) }}" class="text-blue-600">Edit</a>
                                <form method="POST" action="{{ route('collections.destroy', $collection) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
