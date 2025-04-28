@extends('layouts.app')

@section('title', 'Step 3: Upload File')

@section('breadcrumb')
    @include('partials.breadcrumb', ['links' => [
        ['url' => route('repository.dashboard'), 'label' => 'Home'],
        ['label' => 'Step 3: Upload File']
    ]])
@endsection

@section('hero-search')
    @include('partials.hero-search')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-md p-6 max-w-5xl mx-auto">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Step 3: Upload File</h2>

    <form method="POST" action="{{ route('submission.step3') }}" enctype="multipart/form-data">
        @csrf

        <!-- File Upload -->
        <div class="mb-6">
            <label class="block font-medium text-gray-700">Upload File (PDF, DOC, DOCX)</label>
            <input type="file" name="file" accept=".pdf,.doc,.docx"
                   class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400 mt-1" required>
        </div>

        <!-- File Description -->
        <div class="mb-6">
            <label class="block font-medium text-gray-700">File Description</label>
            <textarea name="file_description" rows="3"
                      class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400 mt-1"
                      placeholder="Optional description about the uploaded file."></textarea>
        </div>

        <!-- Embargo Date -->
        <div class="mb-6">
            <label class="block font-medium text-gray-700">Embargo Date (Restrict Download Until)</label>
            <input type="date" name="embargo_date"
                   class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400 mt-1">
        </div>

        <!-- Embargo Reason -->
        <div class="mb-6">
            <label class="block font-medium text-gray-700">Embargo Reason</label>
            <textarea name="embargo_reason" rows="3"
                      class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400 mt-1"
                      placeholder="Explain why download should be restricted (optional)."></textarea>
        </div>

        <!-- Download Permission -->
        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="download_permission" value="1"
                       class="form-checkbox text-yellow-500 focus:ring-2 focus:ring-yellow-400">
                <span class="ml-2 text-gray-700">Allow public download after embargo?</span>
            </label>
        </div>

        <!-- Next Button -->
        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                Review →
            </button>
        </div>
    </form>
</div>
@endsection
