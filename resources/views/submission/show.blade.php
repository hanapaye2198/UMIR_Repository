@extends('layouts.app')

@section('title', $paper->title)

@section('breadcrumb')
    @include('partials.breadcrumb', ['links' => [
        ['url' => route('repository.dashboard'), 'label' => 'Home'],
        ['label' => $paper->title]
    ]])
@endsection

@section('hero-search')
    @include('partials.hero-search')
@endsection

@section('sidebar')
@include('partials.sidebar')
@endsection
@section('content')
<div class="max-w-6xl mx-auto py-10 px-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-red-800 mb-4">{{ $paper->title }}</h1>

        @if ($paper->thumbnail)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $paper->thumbnail) }}" alt="Thumbnail Preview"
                     class="w-full max-w-xs rounded-md shadow-md border">
            </div>
        @endif

        <div class="text-sm text-gray-600 mb-4">
            <strong>Authors:</strong>
            @foreach($paper->authors as $author)
                {{ $author->firstname }} {{ $author->lastname }}@if(!$loop->last), @endif
            @endforeach
            <br>
            <strong>Keywords:</strong>
            {{ $paper->keywords->pluck('name')->join(', ') }}
        </div>

        <div class="prose max-w-none text-gray-800 mb-6">
            <h2 class="text-lg font-semibold">Abstract</h2>
            <p>{{ $paper->abstract }}</p>
        </div>

        @if ($paper->file_path)
            <a href="{{ asset('storage/' . $paper->file_path) }}" target="_blank"
               class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                📄 View/Download Full Paper
            </a>
        @endif
    </div>
</div>
@endsection
