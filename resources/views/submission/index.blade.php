@extends('layouts.app')

@section('title', 'Submitted Papers')

@section('breadcrumb')
    @include('partials.breadcrumb', ['links' => [
        ['url' => route('repository.dashboard'), 'label' => 'Home'],
        ['label' => 'Submitted Papers']
    ]])
@endsection

@section('hero-search')
    @include('partials.hero-search')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-md p-6 max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
            <i class="fas fa-file-alt"></i>
            Submitted Papers
        </h2>
        <a href="{{ route('submission.step1') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
            <i class="fas fa-plus mr-2"></i> Add New Paper
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-800 rounded-lg shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($papers->count())
        <section class="space-y-6">
            @foreach($papers as $paper)
            <div class="flex flex-col sm:flex-row gap-4 border-b pb-6 group hover:bg-gray-50 p-2 rounded-lg transition-colors duration-200 paper-card">
                <div class="flex-shrink-0">
                    <img src="{{ $paper->thumbnail ? asset('storage/' . $paper->thumbnail) : asset('images/sample-thumb.png') }}"
                         class="w-full sm:w-24 h-auto sm:h-32 object-cover border rounded-md shadow-sm group-hover:shadow-md transition-shadow duration-200"
                         alt="thumbnail">
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <h4 class="text-base sm:text-lg font-semibold text-gray-800 group-hover:text-red-700 transition-colors duration-200">
                            {{ $paper->title }}
                        </h4>
                        <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">New</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">
                        <span class="font-medium">
                            @foreach($paper->authors as $author)
                            {{ $author->firstname }} {{ $author->lastname }}
                            @if(!$loop->last), @endif
                            @endforeach
                        </span>
                        <span class="text-gray-500">
                            ({{ $paper->course ?? 'N/A' }}, {{ $paper->date_of_issue ? \Carbon\Carbon::parse($paper->date_of_issue)->format('Y-m') : 'N/A' }}
                            )
                        </span>
                    </p>
                    <p class="text-sm mt-2 text-gray-700 line-clamp-2">
                        {{ Str::limit($paper->abstract, 200) }}
                    </p>
                    <div class="mt-3 flex flex-wrap gap-2 sm:gap-3">
                        <span class="text-xs bg-gray-100 px-2 py-1 rounded-full flex items-center gap-1">
                            <i class="fas fa-eye text-gray-500"></i>
                            <span>{{ $paper->views ?? 0 }} views</span>
                        </span>
                        <span class="text-xs bg-gray-100 px-2 py-1 rounded-full flex items-center gap-1">
                            <i class="fas fa-download text-gray-500"></i>
                            <span>{{ $paper->downloads ?? 0 }} downloads</span>
                        </span>
                        <a href="{{ route('submission.show', $paper->id) }}" class="text-xs text-blue-600 hover:underline ml-auto flex items-center gap-1">
                            <i class="fas fa-external-link-alt"></i>
                            <span>View details</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </section>

        <div class="mt-6">
            {{ $papers->links() }}
        </div>
    @else
        <div class="text-center py-8 text-gray-500">
            No papers submitted yet.
        </div>
    @endif
</div>
@endsection
