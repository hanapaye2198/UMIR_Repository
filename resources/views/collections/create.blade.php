@extends('layouts.app')

@section('title', 'Add Collection')

@section('breadcrumb')
    @include('partials.breadcrumb', ['links' => [
        ['url' => route('repository.dashboard'), 'label' => 'Home'],
        ['url' => route('collections.index'), 'label' => 'Collections'],
        ['label' => 'Add Collection']
    ]])
@endsection

@section('hero-search')
    @include('partials.hero-search')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<div class="py-6 max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add New Collection</h2>

        <form method="POST" action="{{ route('collections.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Collection Name</label>
                <input type="text" name="name" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Community</label>
                <select name="community_id" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400" required>
                    @foreach($communities as $community)
                        <option value="{{ $community->id }}">{{ $community->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400"></textarea>
            </div>

            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
                <i class="fas fa-save mr-2"></i> Save
            </button>
        </form>
    </div>
</div>
@endsection
