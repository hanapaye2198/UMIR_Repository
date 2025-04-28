@extends('layouts.app')

@section('title', 'Add New Community')

@section('breadcrumb')
    @include('partials.breadcrumb', ['links' => [
        ['url' => route('repository.dashboard'), 'label' => 'Home'],
        ['url' => route('communities.index'), 'label' => 'Communities'],
        ['label' => 'Add Community']
    ]])
@endsection

@section('hero-search')
    @include('partials.hero-search')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-md p-6 max-w-2xl mx-auto">
  <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add New Community</h2>

  <form method="POST" action="{{ route('communities.store') }}">
    @csrf

    <div class="mb-4">
      <label class="block font-medium text-gray-700 mb-2">Community Name</label>
      <input type="text" name="name" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400" required>
    </div>

    <div class="mb-4">
      <label class="block font-medium text-gray-700 mb-2">Description</label>
      <textarea name="description" rows="4" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400"></textarea>
    </div>

    <div class="flex justify-end">
      <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
        <i class="fas fa-save mr-2"></i> Save Community
      </button>
    </div>
  </form>
</div>
@endsection
