<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @extends('layouts.app')

                    @section('content')
                    <div class="container">
                        <h1>{{ $community->name }}</h1>

                        <div class="card mb-4">
                            <div class="card-body">
                                @if($community->logo)
                                    <img src="{{ asset('storage/'.$community->logo) }}" alt="Logo" class="img-fluid mb-3" style="max-height: 200px;">
                                @endif
                                <p class="card-text">{{ $community->description }}</p>

                                <div class="mt-4">
                                    <h4>Collections in this Community</h4>
                                    @if($community->collections->count() > 0)
                                        <ul class="list-group">
                                            @foreach($community->collections as $collection)
                                                <li class="list-group-item">
                                                    <a href="{{ route('collections.show', $collection->id) }}">{{ $collection->name }}</a>
                                                    <p class="mb-0">{{ Str::limit($collection->description, 100) }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No collections found in this community.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('communities.index') }}" class="btn btn-secondary">Back to Communities</a>
                        <a href="{{ route('communities.edit', $community->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                    @endsection
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
