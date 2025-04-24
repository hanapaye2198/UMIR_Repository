<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Step 3: Upload File') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('submission.step3') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- File Upload -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Upload File *</label>
                        <input type="file" name="file"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <!-- File Description -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">File Description</label>
                        <input type="text" name="file_description"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Embargo Date -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Embargo Until (optional)</label>
                        <input type="date" name="embargo_date"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Embargo Reason -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Embargo Reason (optional)</label>
                        <textarea name="embargo_reason" rows="3"
                                  class="w-full mt-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between">
                        <a href="{{ route('submission.step2') }}"
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
