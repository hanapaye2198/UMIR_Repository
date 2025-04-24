<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Submitted Papers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Title</th>
                            <th class="px-4 py-2 text-left">Authors</th>
                            <th class="px-4 py-2 text-left">Keywords</th>
                            <th class="px-4 py-2 text-left">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($papers as $paper)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $paper->title }}</td>
                                <td class="px-4 py-2">
                                    {{ $paper->authors->pluck('name')->implode(', ') }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $paper->keywords->pluck('name')->implode(', ') }}
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ asset('storage/' . $paper->file_path) }}" class="text-blue-600 hover:underline" target="_blank">Download</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">No papers submitted yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
