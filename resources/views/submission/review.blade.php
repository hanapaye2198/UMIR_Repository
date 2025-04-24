<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Step 4: Review & Submit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-4 text-gray-700">Review your submission</h3>

                <!-- STEP 1 -->
                <div class="mb-6">
                    <h4 class="font-bold text-gray-800 mb-2">Basic Information</h4>
                    <p><strong>Title:</strong> {{ session('submission.step1.title') }}</p>
                    <p><strong>Authors:</strong> {{ implode(', ', session('submission.step1.authors') ?? []) }}</p>
                    <p><strong>Date of Issue:</strong> {{ session('submission.step1.date_of_issue') }}</p>
                    <p><strong>Publisher:</strong> {{ session('submission.step1.publisher') }}</p>
                    <p><strong>Citation:</strong> {{ session('submission.step1.citation') }}</p>
                </div>

                <!-- STEP 2 -->
                <div class="mb-6">
                    <h4 class="font-bold text-gray-800 mb-2">Content Information</h4>
                    <p><strong>Keywords:</strong> {{ implode(', ', session('submission.step2.keywords') ?? []) }}</p>
                    <p><strong>Abstract:</strong> {{ session('submission.step2.abstract') }}</p>
                    <p><strong>Sponsors:</strong> {{ session('submission.step2.sponsors') }}</p>
                    <p><strong>Description:</strong> {{ session('submission.step2.description') }}</p>
                </div>

                <!-- STEP 3 -->
                <div class="mb-6">
                    <h4 class="font-bold text-gray-800 mb-2">File Details</h4>
                    <p><strong>File Path:</strong> {{ session('submission.step3.file_path') }}</p>
                    <p><strong>File Description:</strong> {{ session('submission.step3.file_description') }}</p>
                    <p><strong>Embargo Date:</strong> {{ session('submission.step3.embargo_date') }}</p>
                    <p><strong>Embargo Reason:</strong> {{ session('submission.step3.embargo_reason') }}</p>
                </div>

                <form method="POST" action="{{ route('submission.submit') }}">
                    @csrf
                    <div class="flex justify-between mt-6">
                        <a href="{{ route('submission.step3') }}"
                           class="bg-gray-200 hover:bg-gray-300 text-black px-4 py-2 rounded">
                            ← Previous
                        </a>
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
                            Submit
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
