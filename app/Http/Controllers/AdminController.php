<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DownloadRequest;
use App\Models\Paper;
class AdminController extends Controller
{
   // Show dashboard with all users
   public function dashboard()
{
    $users = User::all();

    $submissionCount = \App\Models\Paper::count(); // total papers
    $newSubmissions = \App\Models\Paper::whereDate('created_at', today())->count();

    $collectionCount = \App\Models\Collection::count();
    $activeCollections = \App\Models\Collection::where('created_at')->count(); // optional if you have status

    $communityCount = \App\Models\Community::count();
    $newCommunities = \App\Models\Community::whereDate('created_at', today())->count();

    return view('admin.dashboard', compact(
        'users',
        'submissionCount',
        'newSubmissions',
        'collectionCount',
        'activeCollections',
        'communityCount',
        'newCommunities'
    ));
}
public function viewAnalytics()
{
    $papers = Paper::select('title', 'views', 'downloads')
        ->orderByDesc('views')
        ->take(10) // Limit to top 10 viewed papers
        ->get();

    return view('admin.analytics', compact('papers'));
}
public function updateUser(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'role' => 'required|in:student,faculty,librarian',
        'status' => 'required|in:approved,pending',
    ]);

    $user = User::findOrFail($request->user_id);
    $user->role = $request->role;
    $user->status = $request->status;
    $user->save();

    return back()->with('success', 'User updated successfully.');
}

    // Approve a user and assign faculty role
  public function approveUser($id)
{
    $user = User::findOrFail($id);
    $user->role = 'librarian'; // <- instead of faculty
    $user->status = 'approved';
    $user->save();

    return redirect()->back()->with('success', 'User approved as librarian.');
}
public function viewDownloadRequests()
{
    $requests = DownloadRequest::with(['user', 'paper'])->where('status', 'pending')->get();
    return view('admin.download-requests', compact('requests'));
}

public function approveRequest(DownloadRequest $request)
{
    $request->update(['status' => 'approved']);

    // Update paper to allow download
    $request->paper->update(['download_permission' => true]);

    return back()->with('success', 'Request approved. Paper is now downloadable.');
}

public function denyRequest(DownloadRequest $request)
{
    $request->update(['status' => 'denied']);
    return back()->with('error', 'Request denied.');
}
}
