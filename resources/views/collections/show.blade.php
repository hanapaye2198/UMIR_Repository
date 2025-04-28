@extends('layouts.app')

@section('title', $collection->name)

@section('breadcrumb')
    @include('partials.breadcrumb', ['links' => [
        ['url' => route('repository.dashboard'), 'label' => 'Home'],
        ['url' => route('collections.index'), 'label' => 'Collections'],
        ['label' => $collection->name]
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
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">{{ $collection->name }}</h2>
        <div class="flex space-x-2">
            <a href="{{ route('collections.edit', $collection->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('collections.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>
    </div>

    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Community</h3>
        <p class="text-gray-600">{{ $collection->community->name }}</p>
    </div>

    <div class="mb-8">
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Description</h3>
        <p class="text-gray-600">{{ $collection->description ?? 'No description provided.' }}</p>
    </div>

    {{-- Optional: Future Related Papers Section --}}
    {{--
    <div>
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Papers in this Collection</h3>
        @if($collection->papers->count() > 0)
            <ul class="list-disc list-inside text-gray-600">
                @foreach($collection->papers as $paper)
                    <li>
                        <a href="{{ route('papers.show', $paper->id) }}" class="text-blue-600 hover:underline">
                            {{ $paper->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No papers found under this collection.</p>
        @endif
    </div>
    --}}
</div>
@endsection
