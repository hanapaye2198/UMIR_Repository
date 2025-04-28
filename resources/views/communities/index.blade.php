@extends('layouts.app')

@section('title', 'UMIR Communities')

@section('breadcrumb')
    @include('partials.breadcrumb', ['links' => [
        ['url' => route('repository.dashboard'), 'label' => 'Home'],
        ['label' => 'Communities']
    ]])
@endsection


@section('hero-search')
  @include('partials.hero-search')
@endsection

@section('sidebar')
  @include('partials.sidebar')
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-md p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">UMIR Communities</h2>
    <a href="{{ route('communities.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
      <i class="fas fa-plus mr-2"></i> New Community
    </a>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($communities as $community)
    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
      <div class="flex justify-between items-start">
        <h3 class="text-lg font-semibold text-red-700">
          <a href="{{ route('communities.show', $community->id) }}" class="hover:underline">
            {{ $community->name }}
          </a>
        </h3>
        <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">{{ $community->collections_count }} collections</span>
      </div>
      <p class="text-sm text-gray-600 mt-2">{{ Str::limit($community->description, 100) }}</p>
      <div class="mt-4 flex justify-between items-center">
        <span class="text-xs text-gray-500">Created {{ $community->created_at->diffForHumans() }}</span>
        <div class="flex space-x-2">
          <a href="{{ route('communities.edit', $community->id) }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-edit"></i>
          </a>
          <form action="{{ route('communities.destroy', $community->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">
              <i class="fas fa-trash"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="mt-6">
    {{ $communities->links() }}
  </div>
</div>
@endsection
