<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paper;
use App\Models\Author;
use App\Models\Keyword;

class PaperSubmissionController extends Controller
{
    public function index()
    {
        $papers = Paper::with(['authors', 'keywords'])->latest()->get();
        return view('submission.index', compact('papers'));
    }

    public function step1()
    {
        return view('submission.step1');
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'authors' => 'array',
            'date_of_issue' => 'nullable|date',
            'publisher' => 'nullable|string',
            'citation' => 'nullable|string',
            'collection_id' => 'required|exists:collections,id',
        ]);

        session(['submission.step1' => $validated]);

        return redirect()->route('submission.step2');
    }

    public function step2()
    {
        return view('submission.step2');
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'keywords' => 'array',
            'abstract' => 'nullable|string',
            'sponsors' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        session(['submission.step2' => $validated]);

        return redirect()->route('submission.step3');
    }

    public function step3()
    {
        return view('submission.step3');
    }

    public function storeStep3(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx',
            'file_description' => 'nullable|string',
            'embargo_date' => 'nullable|date',
            'embargo_reason' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
            $validated['file_path'] = $path;
        }

        unset($validated['file']);

        session(['submission.step3' => $validated]);

        return redirect()->route('submission.review');
    }

    public function review()
    {
        return view('submission.review');
    }

    public function submit(Request $request)
    {
        $step1 = session('submission.step1');
        $step2 = session('submission.step2');
        $step3 = session('submission.step3');

        $paper = Paper::create([
            'title' => $step1['title'],
            'abstract' => $step2['abstract'] ?? null,
            'publication_date' => $step1['date_of_issue'] ?? null,
            'file_path' => $step3['file_path'],
            'description' => $step2['description'] ?? null,
            'collection_id' => $step1['collection_id'],
        ]);

        foreach ($step1['authors'] as $authorName) {
            $nameParts = explode(',', $authorName);

            $last = trim($nameParts[0] ?? '');
            $first = trim($nameParts[1] ?? '');

            if (empty($first)) {
                $first = $last;
                $last = '';
            }

            $author = Author::firstOrCreate([
                'firstname' => $first,
                'lastname' => $last,
            ]);

            $paper->authors()->attach($author->id);
        }

        if (!empty($step2['keywords'])) {
            foreach ($step2['keywords'] as $keyword) {
                $key = Keyword::firstOrCreate(['name' => $keyword]);
                $paper->keywords()->attach($key->id);
            }
        }

        session()->forget('submission');

        return redirect()->route('submission.step1')->with('success', 'Paper submitted successfully!');
    }
    public function show($id)
{
    $paper = Paper::with(['authors', 'keywords'])->findOrFail($id);
    return view('submission.show', compact('paper'));
}

}
