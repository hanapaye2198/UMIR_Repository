<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Community</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <form method="POST" action="{{ route('communities.update', $community) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block">Name</label>
                <input type="text" name="name" value="{{ $community->name }}" class="w-full border rounded px-4 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded px-4 py-2">{{ $community->description }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
