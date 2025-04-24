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
                        <div class="card">
                            <div class="card-header">
                                <h2>{{ $paper->title }}</h2>
                                <p class="mb-0 text-muted">{{ $paper->type }}</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="mb-3">Details</h4>

                                        <div class="mb-3">
                                            <h5>Authors</h5>
                                            <ul class="list-unstyled">
                                                @foreach($paper->authors as $author)
                                                    <li>{{ $author->lastname }}, {{ $author->firstname }}</li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h5>Publication Information</h5>
                                                <p><strong>Date of Issue:</strong> {{ $paper->date_of_issue ? $paper->date_of_issue->format('F Y') : 'N/A' }}</p>
                                                <p><strong>Publisher:</strong> {{ $paper->publisher ?? 'N/A' }}</p>
                                                <p><strong>Identifier:</strong> {{ $paper->identifier ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Metadata</h5>
                                                <p><strong>Type:</strong> {{ $paper->type ?? 'N/A' }}</p>
                                                <p><strong>Language:</strong> {{ $paper->language ?? 'N/A' }}</p>
                                                <p><strong>Keywords:</strong> {{ $paper->keywords->pluck('name')->implode(', ') }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <h5>Abstract</h5>
                                            <p>{{ $paper->abstract ?? 'No abstract available.' }}</p>
                                        </div>

                                        @if($paper->description)
                                        <div class="mb-3">
                                            <h5>Description</h5>
                                            <p>{{ $paper->description }}</p>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <i class="fas fa-file-pdf fa-5x text-danger mb-3"></i>
                                                <h5 class="card-title">{{ basename($paper->file_path) }}</h5>
                                                <p class="text-muted mb-2">{{ round($paper->file_size / 1024) }} KB</p>
                                                <p class="text-muted">{{ $paper->file_description }}</p>

                                                @if($paper->download_permission)
                                                    <a href="{{ route('collections.papers.download', [$collection->id, $paper->id]) }}"
                                                       class="btn btn-primary btn-block mt-3">
                                                        <i class="fas fa-download"></i> Download PDF
                                                    </a>
                                                @else
                                                    <button class="btn btn-secondary btn-block mt-3" disabled>
                                                        <i class="fas fa-ban"></i> Download Restricted
                                                    </button>
                                                    <small class="text-muted">Contact administrator for access</small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="card mt-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Collection Information</h5>
                                                <p class="mb-1"><strong>Collection:</strong> {{ $collection->name }}</p>
                                                <p class="mb-1"><strong>Community:</strong> {{ $collection->community->name }}</p>
                                                <a href="{{ route('collections.show', $collection->id) }}" class="btn btn-sm btn-outline-primary mt-2">
                                                    View Collection
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('collections.papers.index', $collection->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to Papers List
                                </a>
                                <a href="{{ route('collections.papers.edit', [$collection->id, $paper->id]) }}"
                                   class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
