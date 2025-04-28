@extends('layouts.app')

@section('title', 'Step 2: Describe Item (Keywords and Abstract)')

@section('breadcrumb')
    @include('partials.breadcrumb', ['links' => [
        ['url' => route('repository.dashboard'), 'label' => 'Home'],
        ['label' => 'Step 2: Keywords and Abstract']
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
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Step 2: Describe Item (Keywords and Abstract)</h2>

    <form method="POST" action="{{ route('submission.step2') }}">
        @csrf

        <!-- Keywords -->
        <div class="mb-6">
            <label class="block font-medium text-gray-700">Keywords</label>
            <div id="keywords-wrapper" class="space-y-2 mb-4"></div>

            <div class="flex gap-2">
                <input type="text" id="keyword-input"
                       class="flex-1 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400"
                       placeholder="Enter keyword">
                <button type="button" onclick="addKeyword()"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    Add
                </button>
            </div>
            <small class="text-gray-500">You can add multiple keywords related to the item.</small>
        </div>

        <!-- Abstract -->
        <div class="mb-6">
            <label class="block font-medium text-gray-700">Abstract</label>
            <textarea name="abstract" rows="5"
                      class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400"
                      placeholder="Enter abstract..."></textarea>
        </div>

        <!-- Sponsors -->
        <div class="mb-6">
            <label class="block font-medium text-gray-700">Sponsors</label>
            <input type="text" name="sponsors"
                   class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400"
                   placeholder="e.g. CHED, DOST, USAID">
        </div>

        <!-- Description -->
        <div class="mb-6">
            <label class="block font-medium text-gray-700">Description</label>
            <textarea name="description" rows="5"
                      class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400"
                      placeholder="Additional description..."></textarea>
        </div>

        <!-- Next Button -->
        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                Next →
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let keywordIndex = 0;

        window.addKeyword = function() {
            const keywordInput = document.getElementById('keyword-input');
            const keyword = keywordInput.value.trim();
            if (!keyword) {
                alert('Please enter a keyword.');
                return;
            }

            const wrapper = document.getElementById('keywords-wrapper');

            const div = document.createElement('div');
            div.classList.add('flex', 'items-center', 'justify-between', 'border', 'border-gray-300', 'rounded', 'p-2', 'bg-gray-50');

            div.innerHTML = `
                <div class="text-gray-800">${keyword}</div>
                <div class="flex gap-2 items-center">
                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-red-600 hover:text-red-800 text-sm font-semibold">Remove</button>
                </div>
                <input type="hidden" name="keywords[${keywordIndex}]" value="${keyword}">
            `;

            wrapper.appendChild(div);

            keywordInput.value = '';
            keywordIndex++;
        }
    });
</script>
@endpush
