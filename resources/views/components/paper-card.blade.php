@props(['thumbnail', 'title', 'authors', 'course', 'date', 'abstract'])

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <img src="{{ $thumbnail }}" alt="Thumbnail" class="w-full h-48 object-cover">
    <div class="p-4">
        <h2 class="text-lg font-semibold">{{ $title }}</h2>
        <p class="text-sm text-gray-600 mt-1">{{ $authors }} ({{ $course }}, {{ $date }})</p>
        <p class="text-sm mt-2">{{ \Illuminate\Support\Str::limit($abstract, 180) }}</p>
    </div>
</div>
