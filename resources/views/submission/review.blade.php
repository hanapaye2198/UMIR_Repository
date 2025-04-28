@extends('layouts.app')

@section('title', 'Step 4: Review & Submit')

@section('breadcrumb')
    @include('partials.breadcrumb', ['links' => [
        ['url' => route('repository.dashboard'), 'label' => 'Home'],
        ['label' => 'Step 4: Review & Submit']
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
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Step 4: Review & Submit</h2>

    <h3 class="text-lg font-semibold mb-4 text-gray-700">Review your submission</h3>

    <!-- STEP 1 -->
    <div class="mb-8">
        <h4 class="font-bold text-gray-800 mb-2">Basic Information</h4>
        <div class="space-y-1 text-gray-700">
            <p><strong>Title:</strong> {{ session('submission.step1.title') }}</p>
            <p><strong>Authors:</strong>
                {{ implode(', ', array_map(function($author) {
                    return $author['lastname'] . ', ' . $author['firstname'];
                }, session('submission.step1.authors') ?? [])) }}
            </p>

            <p><strong>Date of Issue:</strong> {{ session('submission.step1.date_of_issue') }}</p>
            <p><strong>Publisher:</strong> {{ session('submission.step1.publisher') }}</p>
            <p><strong>Citation:</strong> {{ session('submission.step1.citation') }}</p>
        </div>
    </div>

    <!-- STEP 2 -->
    <div class="mb-8">
        <h4 class="font-bold text-gray-800 mb-2">Content Information</h4>
        <div class="space-y-1 text-gray-700">
            <p><strong>Keywords:</strong> {{ implode(', ', session('submission.step2.keywords') ?? []) }}</p>
            <p><strong>Abstract:</strong> {{ session('submission.step2.abstract') }}</p>
            <p><strong>Sponsors:</strong> {{ session('submission.step2.sponsors') }}</p>
            <p><strong>Description:</strong> {{ session('submission.step2.description') }}</p>
        </div>
    </div>

    <!-- STEP 3 -->
    <div class="mb-8">
        <h4 class="font-bold text-gray-800 mb-2">File Details</h4>
        <div class="space-y-1 text-gray-700">
            <p><strong>File Path:</strong> {{ session('submission.step3.file_path') }}</p>
            <p><strong>File Description:</strong> {{ session('submission.step3.file_description') }}</p>
            <p><strong>Embargo Date:</strong> {{ session('submission.step3.embargo_date') }}</p>
            <p><strong>Embargo Reason:</strong> {{ session('submission.step3.embargo_reason') }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('submission.submit') }}">
        @csrf
        <div class="flex justify-between mt-8">
            <a href="{{ route('submission.step3') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg shadow-md transition duration-200">
                ← Previous
            </a>
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                Submit →
            </button>
        </div>
    </form>
</div>
@endsection
