<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Models\Paper;
use App\Models\Author;
use App\Models\Keyword;
use App\Models\User;

class SidebarViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('partials.sidebar', function ($view) {
            $quickLinks = [
                ['label' => 'Submit Research', 'url' => route('submission.index')],
                ['label' => 'Browse Collections', 'url' => route('collections.index')],
                ['label' => 'Research Guidelines', 'url' => '#'],
                ['label' => 'Help & Tutorials', 'url' => '#'],
            ];

            $accountLinks = [
                ['label' => 'Logout', 'url' => route('logout'), 'icon' => 'sign-out-alt'],
                ['label' => 'Profile', 'url' => route('profile.edit'), 'icon' => 'user-edit'],
                ['label' => 'Submissions', 'url' => route('submission.index'), 'icon' => 'file-upload'],
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

            $dateIssued = [
                ['label' => '2020 - 2024', 'count' => Paper::whereBetween('date_of_issue', ['2020-01-01', '2024-12-31'])->count()],
                ['label' => '2010 - 2019', 'count' => Paper::whereBetween('date_of_issue', ['2010-01-01', '2019-12-31'])->count()],
            ];

            $fileCounts = [
                'yes' => Paper::whereNotNull('file_path')->count(),
                'no' => Paper::whereNull('file_path')->count(),
            ];

            $view->with(compact(
                'quickLinks',
                'accountLinks',
                'stats',
                'topAuthors',
                'topKeywords',
                'dateIssued',
                'fileCounts'
            ));
        });
    }

    public function register() {}
}
