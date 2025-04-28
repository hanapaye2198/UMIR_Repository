@extends('layouts.app')

@section('title', $community->name)

@section('breadcrumb')
    @include('partials.breadcrumb', ['links' => [
        ['url' => route('repository.dashboard'), 'label' => 'Home'],
        ['url' => route('communities.index'), 'label' => 'Communities'],
        ['label' => $community->name]
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
        <h2 class="text-2xl font-semibold text-gray-800">{{ $community->name }}</h2>
        <div class="flex space-x-2">
            <a href="{{ route('communities.edit', $community->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('communities.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>
    </div>

    @if($community->logo)
        <div class="mb-6 text-center">
            <img src="{{ asset('storage/'.$community->logo) }}" alt="Logo" class="mx-auto rounded-md shadow-md" style="max-height: 200px;">
        </div>
    @endif

    <div class="mb-8">
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Description</h3>
        <p class="text-gray-600">{{ $community->description ?? 'No description provided.' }}</p>
    </div>

    <div>
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Collections in this Community</h3>

        @if($community->collections->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($community->collections as $collection)
                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                        <h4 class="text-lg font-semibold text-red-700 mb-2">
                            <a href="{{ route('collections.show', $collection->id) }}" class="hover:underline">
                                {{ $collection->name }}
                            </a>
                        </h4>
                        <p class="text-sm text-gray-600">{{ Str::limit($collection->description, 100) }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No collections found in this community.</p>
        @endif
    </div>
</div>
@endsection
