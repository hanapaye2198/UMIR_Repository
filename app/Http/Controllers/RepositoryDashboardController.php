<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Models\Community;
use App\Models\Paper;
use App\Models\Author;
use App\Models\Keyword;
use App\Models\User;

class RepositoryDashboardController extends Controller
{
    public function index()
    {
        $communities = Community::withCount(['collections', 'papers'])->get();
        $recentPapers = Paper::with(['authors', 'keywords'])->latest()->take(5)->get();

        $quickLinks = [
            ['label' => 'Submit Research', 'url' => route('papers.index')],
            ['label' => 'Browse Collections', 'url' => route('collections.index')],
            ['label' => 'Research Guidelines', 'url' => '#'],
            ['label' => 'Help & Tutorials', 'url' => '#'],
        ];

        $accountLinks = [
            ['label' => 'Logout', 'url' => route('logout'), 'icon' => 'sign-out-alt'],
            ['label' => 'Profile', 'url' => route('papers.index'), 'icon' => 'user-edit'],
            ['label' => 'Submissions', 'url' => route('papers.index'), 'icon' => 'file-upload'],
            ['label' => 'Saved Items', 'url' => '#', 'icon' => 'bookmark'],
        ];

        $stats = [
            'total_items' => Paper::count(),
            'this_month' => Paper::whereMonth('created_at', now()->month)->count(),
            'downloads' => Paper::sum('downloads'),
            'active_users' => User::count(),
        ];

        $topAuthors = Author::withCount('papers')->orderByDesc('papers_count')->take(5)->get();
        $topKeywords = Keyword::withCount('papers')->orderByDesc('papers_count')->take(5)->get();

        $dateColumn = Schema::hasColumn('papers', 'published_date') ? 'published_date' : 'created_at';
        $dateCounts = Paper::selectRaw("YEAR($dateColumn) as year, COUNT(*) as total")
                           ->groupBy('year')
                           ->orderBy('year', 'desc')
                           ->get();

        $dateIssued = [
            [
                'label' => '2020 - 2024',
                'count' => Paper::whereBetween('date_of_issue', ['2020-01-01', '2024-12-31'])->count()
            ],
            [
                'label' => '2010 - 2019',
                'count' => Paper::whereBetween('date_of_issue', ['2010-01-01', '2019-12-31'])->count()
            ]
        ];

        $fileCounts = [
            'yes' => Paper::whereNotNull('file_path')->count(),
            'no' => Paper::whereNull('file_path')->count(),
        ];

        $user = Auth::user();

        return view('repository.dashboard', compact(
            'communities',
            'recentPapers',
            'quickLinks',
            'accountLinks',
            'stats',
            'topAuthors',
            'topKeywords',
            'dateCounts',
            'dateIssued',
            'fileCounts',
            'user'
        ));
    }
}
