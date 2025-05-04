@extends('layouts.app')

@section('title', 'Review Submission')

@section('breadcrumb')
    @include('partials.breadcrumb', ['links' => [
        ['url' => route('repository.dashboard'), 'label' => 'Home'],
        ['label' => 'Review Submission']
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
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Review Submission</h2>

    <div class="space-y-6">
        <!-- Step 1 Summary -->
        <div>
            <h3 class="text-lg font-bold">Basic Information</h3>
            <p><strong>Title:</strong> {{ session('submission.step1.title') }}</p>
            <p><strong>Other Title:</strong> {{ session('submission.step1.other_title') }}</p>
            <p><strong>Authors:</strong>
                <ul class="list-disc ml-5">
                    @foreach(session('submission.step1.authors', []) as $author)
                        <li>{{ $author['firstname'] }} {{ $author['lastname'] }}</li>
                    @endforeach
                </ul>
            </p>
            <p><strong>Publisher:</strong> {{ session('submission.step1.publisher') }}</p>
            <p><strong>Collection ID:</strong> {{ session('submission.step1.collection_id') }}</p>
        </div>

        <!-- Step 2 Summary -->
        <div>
            <h3 class="text-lg font-bold">Description</h3>
            <p><strong>Abstract:</strong> {{ session('submission.step2.abstract') }}</p>
            <p><strong>Keywords:</strong> {{ implode(', ', session('submission.step2.keywords', [])) }}</p>
            <p><strong>Description:</strong> {{ session('submission.step2.description') }}</p>
        </div>

        <!-- Step 3 Summary -->
        <div>
            <h3 class="text-lg font-bold">Uploaded File</h3>
            <p><strong>File Path:</strong> {{ session('submission.step3.file_path') }}</p>
            <p><strong>Description:</strong> {{ session('submission.step3.file_description') }}</p>
            <p><strong>Embargo Date:</strong> {{ session('submission.step3.embargo_date') }}</p>
            <p><strong>Download Permission:</strong> {{ session('submission.step3.download_permission') ? 'Yes' : 'No' }}</p>

            @php
                $thumbnail = 'storage/thumbnails/' . basename(session('submission.step3.file_path', 'default.jpg'));
            @endphp

            <div class="mt-4">
                <h4 class="font-semibold">Thumbnail Preview:</h4>
                <img src="{{ asset($thumbnail) }}" alt="Thumbnail" class="w-64 border rounded shadow">
            </div>
        </div>

        <!-- Submit Button -->
        <form action="{{ route('submission.submit') }}" method="POST">
            @csrf
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                    Submit Paper
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
