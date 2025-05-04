@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <h2 class="text-xl font-semibold mb-4">
        Results for "{{ $query }}" in {{ ucfirst($field) }}
    </h2>

    @if($results->count())
        <ul class="space-y-4">
            @foreach($results as $paper)
                <li class="border-b pb-4">
                    <h3 class="text-lg font-bold text-blue-700">{{ $paper->title }}</h3>
                    <p class="text-sm text-gray-700">
                        Authors:
                        @foreach($paper->authors as $author)
                            {{ $author->firstname }} {{ $author->lastname }}@if(!$loop->last), @endif
                        @endforeach
                    </p>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($paper->abstract, 150) }}</p>
                    <a href="{{ route('submission.show', $paper->id) }}" class="text-sm text-blue-600 hover:underline mt-1 inline-block">
                        View Details →
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="mt-6">
            {{ $results->links() }}
        </div>
    @else
        <p class="text-gray-500">No results found.</p>
    @endif
</div>
@endsection
