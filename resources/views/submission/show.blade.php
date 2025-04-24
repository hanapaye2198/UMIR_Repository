<x-app-layout>

    <div class="max-w-6xl mx-auto py-10 px-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-red-800 mb-2">{{ $paper->title }}</h1>

            <div class="text-sm text-gray-600 mb-4">
                <strong>Authors:</strong> {{ $paper->authors->pluck('name')->join(', ') }}<br>
                <strong>Keywords:</strong> {{ $paper->keywords->pluck('word')->join(', ') }}
            </div>

            <div class="prose max-w-none text-gray-800 mb-6">
                <h2 class="text-lg font-semibold">Abstract</h2>
                <p>{{ $paper->abstract }}</p>
            </div>

            @if ($paper->file_path)
                <a href="{{ asset('storage/' . $paper->file_path) }}" target="_blank"
                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    📄 View/Download Full Paper
                </a>
            @endif
        </div>
    </div>
</x-app-layout>
