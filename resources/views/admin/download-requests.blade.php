@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Download Requests</h2>

    @forelse($requests as $req)
        <div class="mb-4 border-b pb-4">
            <p><strong>Student:</strong> {{ $req->user->name }} ({{ $req->user->email }})</p>
            <p><strong>Paper:</strong> {{ $req->paper->title }}</p>
            <p><strong>Message:</strong> {{ $req->message }}</p>
            <p><strong>Requested Date:</strong> {{ \Carbon\Carbon::parse($req->requested_download_date)->format('F d, Y') }}</p>

            <div class="mt-2 flex gap-2">
                <form action="{{ route('admin.downloadRequests.approve', $req->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Approve</button>
                </form>
                <form action="{{ route('admin.downloadRequests.deny', $req->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Deny</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-gray-600">No pending requests.</p>
    @endforelse
</div>
@endsection
