<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\Paper;
use App\Models\Author;
use App\Models\Keyword;
use Illuminate\Support\Facades\Schema;
class RepositoryDashboardController extends Controller
{
    public function index()
    {
        $communities = Community::withCount(['collections', 'papers'])->get();
        $recentPapers = Paper::with(['authors', 'keywords'])->latest()->take(5)->get();

        $topAuthors = Author::withCount('papers')->orderByDesc('papers_count')->take(5)->get();
        $topKeywords = Keyword::withCount('papers')->orderByDesc('papers_count')->take(5)->get();

        // Check if published_date exists in papers table
        $dateColumn = Schema::hasColumn('papers', 'published_date') ? 'published_date' : 'created_at';

        $dateCounts = Paper::selectRaw("YEAR($dateColumn) as year, COUNT(*) as total")
                           ->groupBy('year')->orderBy('year', 'desc')->get();

        return view('repository.dashboard', compact(
            'communities',
            'recentPapers',
            'topAuthors',
            'topKeywords',
            'dateCounts'
        ));
    }
}
