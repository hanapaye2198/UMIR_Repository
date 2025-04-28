@extends('layouts.app')

@section('title', 'Step 1: Describe Item (Basic Info)')

@section('breadcrumb')
    @include('partials.breadcrumb', ['links' => [
        ['url' => route('repository.dashboard'), 'label' => 'Home'],
        ['label' => 'Step 1: Basic Info']
    ]])
@endsection

@section('hero-search')
    @include('partials.hero-search')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-md p-6 max-w-5xl mx-auto">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Step 1: Describe Item (Basic Information)</h2>

    <form method="POST" action="{{ route('submission.step1') }}">
        @csrf

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Collection</label>
            <select name="collection_id" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400">
                @foreach(\App\Models\Collection::all() as $collection)
                    <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Title -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Title *</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400">
        </div>

        <!-- Other Titles -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Other Titles</label>
            <input type="text" name="other_title" value="{{ old('other_title') }}"
                   class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400">
            <small class="text-gray-500">If the item has any alternative titles, enter them here.</small>
        </div>

        <!-- Authors -->
        <div class="mb-6">
            <label class="block font-medium text-gray-700 mb-2">Authors</label>

            <div class="flex gap-2 mb-4">
                <input type="text" id="last-name" placeholder="Last name" class="flex-1 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400">
                <input type="text" id="first-name" placeholder="First name(s)" class="flex-1 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400">
                <button type="button" onclick="addAuthor()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    Add
                </button>
            </div>

            <div id="authors-list" class="space-y-2">
                <!-- Dynamic authors will appear here -->
            </div>

            <small class="text-gray-500">Enter the names of the authors. You can add multiple.</small>
        </div>

        <!-- Date of Issue -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Date of Issue</label>
            <input type="date" name="date_of_issue" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400">
        </div>

        <!-- Publisher -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Publisher</label>
            <input type="text" name="publisher" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400">
        </div>

        <!-- Citation -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Citation</label>
            <input type="text" name="citation" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400">
        </div>

        <!-- Series/Report No. -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Series/Report No.</label>
            <div class="flex gap-2">
                <input type="text" name="series_name" placeholder="Series Name" class="flex-1 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400">
                <input type="text" name="report_number" placeholder="Report or Paper No." class="flex-1 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400">
            </div>
        </div>

        <!-- Identifiers -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Identifiers</label>
            <div class="flex gap-2">
                <select name="identifier_type" class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400">
                    <option value="">Select Type</option>
                    <option value="ISSN">ISSN</option>
                    <option value="ISBN">ISBN</option>
                    <option value="Other">Other</option>
                </select>
                <input type="text" name="identifier_value" placeholder="Identifier Number" class="flex-1 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400">
            </div>
        </div>

        <!-- Type -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Type</label>
            <select name="type" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400">
                <option value="">Select Type</option>
                <option value="Article">Article</option>
                <option value="Technical Report">Technical Report</option>
                <option value="Thesis">Thesis</option>
                <option value="Video">Video</option>
                <option value="Working Paper">Working Paper</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <!-- Language -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Language</label>
            <select name="language" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400">
                <option value="">Select Language</option>
                <option value="English">English</option>
                <option value="Filipino">Filipino</option>
                <option value="Cebuano">Cebuano</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <!-- Next Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                Next →
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let authorIndex = 0;

        window.addAuthor = function() {
            const lastName = document.getElementById('last-name').value.trim();
            const firstName = document.getElementById('first-name').value.trim();

            if (!lastName || !firstName) {
                alert('Please enter both last name and first name.');
                return;
            }

            const list = document.getElementById('authors-list');

            const card = document.createElement('div');
            card.classList.add('flex', 'items-center', 'justify-between', 'border', 'border-gray-300', 'rounded', 'p-3', 'bg-gray-50');

            card.innerHTML = `
                <div class="text-gray-800 font-medium">${lastName}, ${firstName}</div>
                <div class="flex gap-2 items-center">
                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-red-600 hover:text-red-800 text-sm font-semibold">Remove</button>
                </div>
                <input type="hidden" name="authors[${authorIndex}][lastname]" value="${lastName}">
                <input type="hidden" name="authors[${authorIndex}][firstname]" value="${firstName}">
            `;

            list.appendChild(card);

            document.getElementById('last-name').value = '';
            document.getElementById('first-name').value = '';

            authorIndex++;
        }
    });
</script>
@endpush
