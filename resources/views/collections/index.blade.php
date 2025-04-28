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
<div class="bg-white rounded-xl shadow-md p-6 max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Collections</h2>
        <a href="{{ route('collections.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
            <i class="fas fa-plus mr-2"></i> Add Collection
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-800 rounded-lg shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-lg shadow-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Community</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @foreach($collections as $collection)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-6">{{ $collection->name }}</td>
                        <td class="py-3 px-6">{{ $collection->community->name }}</td>
                        <td class="py-3 px-6">{{ Str::limit($collection->description, 100) }}</td>
                        <td class="py-3 px-6 flex justify-center gap-3">
                            <a href="{{ route('collections.edit', $collection->id) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('collections.destroy', $collection->id) }}" onsubmit="return confirm('Are you sure you want to delete this collection?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $collections->links() }}
        </div>
    </div>
</div>
@endsection
