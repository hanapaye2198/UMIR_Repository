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
                    <h1>{{ $collection->name }}</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Community: <a href="{{ route('communities.show', $collection->community_id) }}">{{ $collection->community->name }}</a></h5>
            <p class="card-text">{{ $collection->description }}</p>
        </div>
    </div>

    <a href="{{ route('collections.index') }}" class="btn btn-secondary">Back to Collections</a>
    <a href="{{ route('collect
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
