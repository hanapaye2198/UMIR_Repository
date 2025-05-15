@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6 flex items-center gap-2">
        <i class="fas fa-chalkboard-teacher text-blue-600"></i>
        <span>Faculty Dashboard</span>
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <a href="{{ route('submission.step1') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4 rounded-xl shadow-md flex items-center justify-between">
            <div>
                <h2 class="font-bold text-lg">Submit New Paper</h2>
                <p class="text-sm text-blue-100">Start the multi-step paper submission</p>
            </div>
            <i class="fas fa-upload text-2xl"></i>
        </a>

        <a href="{{ route('submission.index') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-4 rounded-xl shadow-md flex items-center justify-between">
            <div>
                <h2 class="font-bold text-lg">My Submissions</h2>
                <p class="text-sm text-green-100">View your submitted papers</p>
            </div>
            <i class="fas fa-folder-open text-2xl"></i>
        </a>
    </div>
</div>
@endsection
