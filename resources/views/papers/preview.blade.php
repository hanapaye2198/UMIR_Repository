@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-6 bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold mb-4 text-red-700">{{ $paper->title }}</h2>
    <p class="mb-6 text-gray-700">Previewing first 10 pages only.</p>

    <iframe
        src="{{ asset('pdfjs/web/viewer.html') }}?file={{ asset('storage/' . $paper->file_path) }}#page=1"
        width="100%"
        height="800px"
        style="border: 1px solid #ddd;">
    </iframe>
</div>
@endsection
