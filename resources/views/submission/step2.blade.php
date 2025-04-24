<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Step 2: Describe Item (Content)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('submission.step2') }}">
                    @csrf

                    <!-- Keywords -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Subject Keywords</label>
                        <input type="text" name="keywords[]" placeholder="e.g. Artificial Intelligence"
                               class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Abstract -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Abstract</label>
                        <textarea name="abstract" rows="4"
                                  class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <!-- Sponsors -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Sponsors</label>
                        <input type="text" name="sponsors"
                               class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="3"
                                  class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between">
                        <a href="{{ route('submission.step1') }}"
                           class="inline-block bg-gray-200 hover:bg-gray-300 text-black px-4 py-2 rounded">
                            ← Previous
                        </a>
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
