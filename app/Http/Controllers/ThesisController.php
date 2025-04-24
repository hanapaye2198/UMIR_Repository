<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thesis;

class ThesisController extends Controller
{
    public function index() {
        $theses = Thesis::all();
        $theses = Thesis::orderBy('created_at', 'desc')->paginate(10); // 10 items per page
        return view('thesis.index', compact('theses'));
    }

    public function create() {
        return view('thesis.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'date' => 'required|date',
            'abstract' => 'required',
            'subject' => 'required',
            'file' => 'required|mimes:pdf|max:10000',
        ]);

        $filePath = $request->file('file')->store('thesis_files', 'public');

        Thesis::create([
            'title' => $request->title,
            'author' => $request->author,
            'date' => $request->date,
            'abstract' => $request->abstract,
            'subject' => $request->subject,
            'file_path' => $filePath,
        ]);

        return redirect()->route('thesis.index')->with('success', 'Thesis uploaded!');
    }
    public function view($id)
{
    $thesis = Thesis::findOrFail($id);
    return view('thesis.view', compact('thesis'));
}
public function dashboard()
{
    // Statistics
    $totalTheses = Thesis::count();
    $uniqueAuthors = Thesis::distinct('author')->count('author');
    $thisMonthTheses = Thesis::whereMonth('created_at', now()->month)->count();
    $categoriesCount = Thesis::distinct('subject')->count('subject');

    // Thesis list for sidebar
    $theses = Thesis::orderBy('created_at', 'desc')
        ->select('title', 'author', 'created_at', 'subject')
        ->limit(5)
        ->get();

    // Recently added theses with thumbnails
    $recentTheses = Thesis::orderBy('created_at', 'desc')
        ->limit(4)
        ->get();

    // Subject data for chart
    $subjectData = [
        'labels' => Thesis::groupBy('subject')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->pluck('subject')
            ->toArray(),
        'data' => Thesis::groupBy('subject')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->selectRaw('COUNT(*) as count')
            ->pluck('count')
            ->toArray()
    ];

    return view('thesis.dashboard', compact(
        'totalTheses',
        'uniqueAuthors',
        'thisMonthTheses',
        'categoriesCount',
        'theses',
        'recentTheses',
        'subjectData'
    ));
}
}
