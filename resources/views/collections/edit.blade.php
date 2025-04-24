<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Collection</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <form method="POST" action="{{ route('collections.update', $collection) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block">Collection Name</label>
                <input type="text" name="name" value="{{ $collection->name }}" class="w-full border rounded px-4 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block">Community</label>
                <select name="community_id" class="w-full border rounded px-4 py-2" required>
                    @foreach($communities as $community)
                        <option value="{{ $community->id }}" {{ $community->id == $collection->community_id ? 'selected' : '' }}>{{ $community->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded px-4 py-2">{{ $collection->description }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
