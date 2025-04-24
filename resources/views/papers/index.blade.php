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
                    <div class="container">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h1>Papers in "{{ $collection->name }}" Collection</h1>
                            <a href="{{ route('collections.papers.create', $collection->id) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Upload New Paper
                            </a>
                        </div>

                        @if($papers->isEmpty())
                            <div class="alert alert-info">No papers found in this collection.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Authors</th>
                                            <th>Type</th>
                                            <th>Year</th>
                                            <th>Download</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($papers as $paper)
                                        <tr>
                                            <td>
                                                <a href="{{ route('collections.papers.show', [$collection->id, $paper->id]) }}">
                                                    {{ $paper->title }}
                                                </a>
                                            </td>
                                            <td>{{ $paper->authors_list }}</td>
                                            <td>{{ $paper->type }}</td>
                                            <td>{{ $paper->date_of_issue ? $paper->date_of_issue->format('Y') : '' }}</td>
                                            <td>
                                                @if($paper->download_permission)
                                                    <a href="{{ route('collections.papers.download', [$collection->id, $paper->id]) }}"
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-download"></i> PDF
                                                    </a>
                                                @else
                                                    <span class="badge badge-secondary">Restricted</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('collections.papers.show', [$collection->id, $paper->id]) }}"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('collections.papers.edit', [$collection->id, $paper->id]) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('collections.papers.destroy', [$collection->id, $paper->id]) }}"
                                                      method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this paper?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $papers->links() }}
                        @endif

                        <a href="{{ route('collections.show', $collection->id) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Collection
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
