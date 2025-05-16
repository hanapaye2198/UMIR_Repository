@extends('layouts.app')

@section('title', $paper->title)

@section('breadcrumb')
    @include('partials.breadcrumb', ['links' => [
        ['url' => route('repository.dashboard'), 'label' => 'Home'],
        ['url' => route('collections.show', $paper->collection->id), 'label' => $paper->collection->name],
        ['label' => $paper->title]
    ]])
@endsection

@section('hero-search')
    @include('partials.hero-search')
@endsection

@section('sidebar')
    @include('partials.sidebar')

    @php
        $isStudent = auth()->check() && auth()->user()->role === 'student';
        $isEmbargoed = $paper->download_date && now()->lt($paper->download_date);
        $hasPermission = $paper->download_permission;
        $requestPending = isset($existingRequest) && $existingRequest->status === 'pending';
    @endphp

    <!-- Additional Paper Info Sidebar -->
    <div class="bg-white rounded-xl shadow-md p-5 mt-6">
        <h4 class="font-semibold text-lg border-b pb-2 text-gray-800 flex items-center gap-2">
            <i class="fas fa-info-circle text-red-600"></i>
            <span>Paper Details</span>
        </h4>
        <div class="mt-3 space-y-3">
            <div>
                <span class="text-sm font-medium text-gray-700">Published:</span>
                <p class="text-sm">{{ $paper->publication_date ? $paper->publication_date->format('F Y') : 'Not specified' }}</p>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-700">Collection:</span>
                <p class="text-sm">{{ $paper->collection->name }}</p>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-700">Community:</span>
                <p class="text-sm">{{ $paper->collection->community->name }}</p>
            </div>
            {{-- <div>
                <span class="text-sm font-medium text-gray-700">Course/Program:</span>
                <p class="text-sm">{{ $paper->course ?? 'Not specified' }}</p>
            </div> --}}
            <div>
                <span class="text-sm font-medium text-gray-700">Keywords:</span>
                <p class="text-sm">
                    @if($paper->keywords)
                        @foreach(explode(',', $paper->keywords) as $keyword)
                            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-1 mb-1">{{ trim($keyword) }}</span>
                        @endforeach
                    @else
                        None specified
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Statistics Sidebar -->
    <div class="bg-white rounded-xl shadow-md p-5 mt-6">
        <h4 class="font-semibold text-lg border-b pb-2 text-gray-800 flex items-center gap-2">
            <i class="fas fa-chart-bar text-red-600"></i>
            <span>Statistics</span>
        </h4>
        <div class="mt-3 space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas fa-eye text-gray-500"></i>
                    <span class="text-sm">Views</span>
                </div>
                <span class="font-medium">{{ number_format($paper->views) }}</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas fa-download text-gray-500"></i>
                    <span class="text-sm">Downloads</span>
                </div>
                <span class="font-medium">{{ number_format($paper->downloads) }}</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas fa-heart text-gray-500"></i>
                    <span class="text-sm">Likes</span>
                </div>
                <span class="font-medium">{{ number_format($paper->likes_count) }}</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas fa-calendar-alt text-gray-500"></i>
                    <span class="text-sm">Added</span>
                </div>
                <span class="font-medium">{{ $paper->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-4xl mx-auto">
    <!-- Paper Header -->
    <div class="bg-gradient-to-r from-red-700 to-red-600 text-white p-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold mb-2">{{ $paper->title }}</h1>
                <div class="flex flex-wrap items-center gap-2 text-sm text-red-100">
                    @if($paper->authors && $paper->authors->count())
                        <span class="flex items-center gap-1">
                            <i class="fas fa-user-edit"></i>
                            {{ $paper->authors->pluck('name')->join(', ') }}
                        </span>
                    @endif
                    @if($paper->publication_date)
                        <span class="flex items-center gap-1">
                            <i class="far fa-calendar"></i>
                            {{ $paper->publication_date->format('F Y') }}
                        </span>
                    @endif
                </div>
            </div>
            @if(auth()->user() && auth()->user()->role === 'librarian')
                @if($paper->file_path)
                <a href="{{ route('papers.download', $paper->id) }}"
                    class="bg-white hover:bg-gray-100 text-red-700 px-5 py-3 rounded-lg shadow-md transition duration-200 flex items-center gap-2">
                    <i class="fas fa-eye"></i>
                    <span>View Full Document</span>
                </a>
                @endif
            @endif
        </div>
    </div>

    <!-- Download Controls -->
<div class="p-6 border-b">
    @if($isStudent)
      <script>
        document.addEventListener("DOMContentLoaded", function () {
            const iframe = document.querySelector('iframe');

            iframe.onload = function () {
                const viewerWindow = iframe.contentWindow;

                // Monitor PDF page changes
                const interval = setInterval(() => {
                    try {
                        const currentPage = viewerWindow.PDFViewerApplication.page;
                        if (currentPage > 10) {
                            alert("You are only allowed to view the first 10 pages as a student.");
                            viewerWindow.PDFViewerApplication.page = 10;
                        }
                    } catch (e) {
                        // PDFViewerApplication might not be ready yet
                    }
                }, 1000);
            };
        });
    </script>
        @if($isEmbargoed)
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4 rounded">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-500 mt-1"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            This paper is under embargo until <strong>{{ \Carbon\Carbon::parse($paper->download_date)->format('F d, Y') }}</strong>.
                            You cannot download it until this date.
                        </p>
                    </div>
                </div>
            </div>
        @elseif(!$hasPermission)
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4 rounded">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            You need permission to download this paper. Please submit a request below.
                        </p>
                    </div>
                </div>
            </div>

            @if($requestPending)
                <div class="bg-purple-50 border-l-4 border-purple-400 p-4 mb-4 rounded">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-clock text-purple-500 mt-1"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-purple-700">
                                Your download request is pending approval.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <button type="button" onclick="document.getElementById('requestModal').showModal()"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-sm flex items-center gap-2 transition duration-200">
                    <i class="fas fa-paper-plane"></i>
                    <span>Request Download Permission</span>
                </button>
            @endif
        @else
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4 rounded">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            Your download permission has been approved. You may now download this paper.
                        </p>
                    </div>
                </div>
            </div>
            <a href="{{ route('papers.download', $paper->id) }}"
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow-sm inline-flex items-center gap-2 transition duration-200">
                <i class="fas fa-download"></i>
                <span>Download Paper</span>
            </a>
        @endif
    @else
        {{-- Non-student users (faculty/librarian) always allowed --}}
        <a href="{{ route('papers.download', $paper->id) }}"
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow-sm inline-flex items-center gap-2 transition duration-200">
            <i class="fas fa-download"></i>
            <span>Download Paper</span>
        </a>
    @endif
</div>


    <!-- Paper Content -->
    <div class="p-6">
        <!-- Abstract Section -->
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-4 border-b pb-2">
                <i class="fas fa-align-left text-red-600"></i>
                <h2 class="text-xl font-semibold text-gray-800">Abstract</h2>
            </div>
            <div class="prose max-w-none text-gray-700">
                {!! nl2br(e($paper->abstract)) !!}
            </div>
        </div>

   <!-- Document Preview Section -->
<div class="mb-8">
    <div class="flex items-center gap-2 mb-4 border-b pb-2">
        <i class="fas fa-file-pdf text-red-600"></i>
        <h2 class="text-xl font-semibold text-gray-800">Document Preview</h2>
    </div>

    @if($paper->file_path)
       @php
    $fileUrl = route('papers.stream', $paper->id);
@endphp


        @if(auth()->user()->role === 'student')
            <!-- Student View (limit page navigation to 10) -->
<iframe
    src="{{ asset('pdfjs/web/viewer.html') }}?file={{ urlencode(route('papers.stream', $paper->id)) }}"
    width="100%"
    height="800px"
    class="w-full border rounded-lg">
</iframe>



            <p class="text-sm text-center text-gray-500 py-2 bg-gray-100">
                Only the first 10 pages are viewable. Downloading is disabled.
            </p>
        @else
            <!-- Faculty / Librarian Full View -->
            <iframe
                src="{{ asset('pdfjs/web/viewer.html') }}?file={{ urlencode($fileUrl) }}"
                width="100%"
                height="800px"
                class="w-full border rounded-lg">
            </iframe>
            <p class="text-sm text-center text-gray-500 py-2 bg-gray-100">
                Full document preview enabled for {{ auth()->user()->role }}.
            </p>
        @endif
    @else
        <div class="text-center text-red-600 py-8 bg-gray-100">
            <i class="fas fa-exclamation-triangle text-4xl mb-2"></i>
            <p class="font-medium">Document not available for preview</p>
        </div>
    @endif
</div>




        <!-- Additional Actions -->
        <div class="flex flex-wrap gap-4 mt-8 pt-6 border-t">
            <a href="{{ route('collections.show', $paper->collection->id) }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow-sm transition duration-200 flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Collection</span>
            </a>

            @can('update', $paper)
            <a href="{{ route('papers.edit', $paper->id) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition duration-200 flex items-center gap-2">
                <i class="fas fa-edit"></i>
                <span>Edit Paper</span>
            </a>
            @endcan

            <button class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow-sm transition duration-200 flex items-center gap-2">
                <i class="fas fa-share-alt"></i>
                <span>Share</span>
            </button>

            <button class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-lg shadow-sm transition duration-200 flex items-center gap-2">
                <i class="fas fa-heart"></i>
                <span>Like ({{ $paper->likes_count }})</span>
            </button>
        </div>
    </div>
</div>

<!-- Related Papers Section -->
<div class="bg-white rounded-xl shadow-md p-6 mt-8 max-w-4xl mx-auto">
    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
        <i class="fas fa-book-open text-red-600"></i>
        <span>Related Papers</span>
    </h2>

    @if($relatedPapers->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($relatedPapers as $related)
        <div class="border rounded-lg p-4 hover:shadow-md transition-shadow duration-200 hover:border-red-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">
                <a href="{{ route('papers.show', $related->id) }}" class="hover:text-red-700 transition duration-200">{{ $related->title }}</a>
            </h3>
            <p class="text-sm text-gray-600 mb-2">
                {{ Str::limit($related->abstract, 100) }}
            </p>
            <div class="flex justify-between items-center text-xs text-gray-500">
                <span>{{ $related->created_at->diffForHumans() }}</span>
                <span>{{ $related->views }} views</span>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-8 text-gray-500">
        <i class="fas fa-inbox text-4xl mb-3"></i>
        <p>No related papers found</p>
    </div>
    @endif
</div>

<!-- Request Modal -->
<dialog id="requestModal" class="rounded-lg shadow-xl p-0 w-full max-w-md">
    <div class="bg-white rounded-lg overflow-hidden">
        <div class="bg-gradient-to-r from-red-700 to-red-600 text-white p-4">
            <h3 class="text-lg font-semibold">Request Download Permission</h3>
        </div>

        <form method="POST" action="{{ route('papers.requestDownloadPermission', $paper->id) }}" class="p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Target Download Date</label>
                <input type="date" name="requested_download_date"
                       class="w-full border rounded-md p-2 focus:ring-red-500 focus:border-red-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Reason for Request</label>
                <textarea name="message" rows="4"
                          class="w-full border rounded-md p-2 focus:ring-red-500 focus:border-red-500"
                          placeholder="Please explain why you need access to this document..." required></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="document.getElementById('requestModal').close()"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-200">
                    Submit Request
                </button>
            </div>
        </form>
    </div>
</dialog>

@endsection

@push('styles')
<style>
      iframe {
        pointer-events: auto;
    }
    @if($isStudent)
    iframe::part(toolbarField.pageNumber) {
        display: none !important;
    }
    @endif
    .prose {
        line-height: 1.6;
        color: #374151;
    }
    .prose p {
        margin-bottom: 1em;
    }
    dialog::backdrop {
        background-color: rgba(0, 0, 0, 0.5);
    }
    .transition {
        transition: all 0.2s ease-in-out;
    }
</style>
<script>
    viewerWindow.document.addEventListener('keydown', function (e) {
    if (e.key === "ArrowRight" || e.key === "PageDown") {
        if (viewerWindow.PDFViewerApplication.page >= 10) {
            e.preventDefault();
            alert("Navigation past page 10 is disabled for student users.");
        }
    }
});

</script>
@endpush
