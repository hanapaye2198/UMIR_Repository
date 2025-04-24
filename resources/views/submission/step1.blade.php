<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Step 1: Describe Item (Basic Info)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('submission.step1') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Collection</label>
                        <select name="collection_id" class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
                            @foreach(\App\Models\Collection::all() as $collection)
                                <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Title -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               required class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Authors -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Authors</label>
                        <input type="text" name="authors[]" placeholder="e.g. Juan Dela Cruz"
                               class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Date of Issue -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Date of Issue</label>
                        <input type="date" name="date_of_issue"
                               class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Publisher -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Publisher</label>
                        <input type="text" name="publisher"
                               class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Citation -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Citation</label>
                        <input type="text" name="citation"
                               class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Next Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                            Next →
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
