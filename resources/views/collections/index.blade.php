@extends('layouts.app')

@section('title', 'Collections')

@section('breadcrumb')
    @include('partials.breadcrumb', ['links' => [
        ['url' => route('repository.dashboard'), 'label' => 'Home'],
        ['label' => 'Collections']
    ]])
@endsection

@section('hero-search')
    @include('partials.hero-search')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header with Stats -->
    <div class="bg-gradient-to-r from-red-700 to-red-600 text-white rounded-xl shadow-lg p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h2 class="text-2xl font-bold mb-2 flex items-center gap-3">
                    <i class="fas fa-layer-group"></i>
                    <span>Research Collections</span>
                </h2>
                <p class="text-red-100">Browse and manage all collections in UMIR</p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center gap-4">
                <div class="text-center bg-white/10 p-3 rounded-lg backdrop-blur-sm">
                    <p class="text-2xl font-bold">{{ $collections->total() }}</p>
                    <p class="text-xs text-red-100">Total Collections</p>
                </div>
                <a href="{{ route('collections.create') }}" class="bg-white hover:bg-gray-100 text-red-700 px-4 py-3 rounded-lg shadow-md transition duration-200 flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>New Collection</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded-lg shadow-sm flex items-center gap-3">
            <i class="fas fa-check-circle text-green-500 text-xl"></i>
            <div>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Collections Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($collections as $collection)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-100">
            <!-- Collection Header -->
            <div class="bg-gradient-to-r from-red-50 to-red-100 px-6 py-4 border-b">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 truncate">
                            <a href="{{ route('collections.show', $collection->id) }}" class="hover:text-red-700 transition-colors">
                                {{ $collection->name }}
                            </a>
                        </h3>
                        <p class="text-sm text-red-600 mt-1">
                            <i class="fas fa-users mr-1"></i>
                            {{ $collection->community->name }}
                        </p>
                    </div>
                    <span class="bg-white text-red-700 text-xs font-semibold px-2 py-1 rounded-full shadow-sm">
                        {{ $collection->papers_count }} {{ Str::plural('Paper', $collection->papers_count) }}
                    </span>
                </div>
            </div>

            <!-- Collection Body -->
            <div class="p-6">
                <p class="text-gray-600 mb-4 line-clamp-3">
                    {{ $collection->description ?? 'No description available' }}
                </p>

                <div class="flex justify-between items-center mt-4 pt-4 border-t">
                    <span class="text-xs text-gray-500">
                        <i class="far fa-calendar-alt mr-1"></i>
                        Created {{ $collection->created_at->diffForHumans() }}
                    </span>
                    <div class="flex gap-2">
                        <a href="{{ route('collections.edit', $collection->id) }}"
                           class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-50 transition-colors"
                           title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form method="POST" action="{{ route('collections.destroy', $collection->id) }}"
                              onsubmit="return confirm('Are you sure you want to delete this collection?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50 transition-colors"
                                    title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($collections->isEmpty())
    <div class="bg-white rounded-xl shadow-md p-12 text-center">
        <div class="mx-auto max-w-md">
            <i class="fas fa-folder-open text-5xl text-gray-400 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-700 mb-2">No Collections Found</h3>
            <p class="text-gray-500 mb-6">Get started by creating your first collection</p>
            <a href="{{ route('collections.create') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-200">
                <i class="fas fa-plus mr-2"></i> Create Collection
            </a>
        </div>
    </div>
    @endif

    <!-- Pagination -->
    @if($collections->hasPages())
    <div class="mt-8 bg-white rounded-xl shadow-sm p-4">
        {{ $collections->links() }}
    </div>
    @endif
</div>
@endsection
