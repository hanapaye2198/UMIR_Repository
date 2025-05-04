<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paper;
use App\Models\Author;
use App\Models\Keyword;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class PaperSubmissionController extends Controller
{
    public function index()
    {
        $papers = Paper::with(['authors', 'keywords'])->latest()->paginate(10);
        return view('submission.index', compact('papers'));
    }


    public function step1()
    {
        return view('submission.step1');
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'collection_id' => 'required|exists:collections,id',
            'title' => 'required|string',
            'other_title' => 'nullable|string',
            'authors' => 'array|required',
            'authors.*.firstname' => 'required|string',
            'authors.*.lastname' => 'required|string',
            'date_of_issue' => 'nullable|date',
            'publisher' => 'nullable|string',
            'citation' => 'nullable|string',
            'series_name' => 'nullable|string',
            'report_number' => 'nullable|string',
            'identifier_type' => 'nullable|string',
            'identifier_value' => 'nullable|string',
            'type' => 'nullable|string',
            'language' => 'nullable|string',
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
            'file' => 'required|file|mimes:pdf,doc,docx|max:51200',
            'file_description' => 'nullable|string',
            'embargo_date' => 'nullable|date',
            'embargo_reason' => 'nullable|string',
            'download_permission' => 'nullable|boolean',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads', 'public');
            $validated['file_path'] = $path;
            $validated['file_size'] = $file->getSize();
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

        // Path sa imong uploaded file
        $filePath = storage_path('app/public/' . $step3['file_path']);

        // Generate thumbnail name
        $thumbnailName = 'thumbnails/' . uniqid() . '.jpg';
        $thumbnailPath = storage_path('app/public/' . $thumbnailName);

        // Use fallback thumbnail if not an image
        $defaultThumbnail = 'thumbnails/default.jpg';
        try {
            $img = Image::make($filePath)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save($thumbnailPath);
        } catch (\Exception $e) {
            $thumbnailName = $defaultThumbnail;
        }

        // Create the Paper
        $paper = Paper::create([
            'collection_id' => $step1['collection_id'],
            'title' => $step1['title'],
            'other_title' => $step1['other_title'] ?? null,
            'date_of_issue' => $step1['date_of_issue'] ?? null,
            'publisher' => $step1['publisher'] ?? null,
            'citation' => $step1['citation'] ?? null,
            'series_name' => $step1['series_name'] ?? null,
            'report_number' => $step1['report_number'] ?? null,
            'identifier_type' => $step1['identifier_type'] ?? null,
            'identifier_value' => $step1['identifier_value'] ?? null,
            'type' => $step1['type'] ?? null,
            'language' => $step1['language'] ?? null,
            'abstract' => $step2['abstract'] ?? null,
            'description' => $step2['description'] ?? null,
            'thumbnail' => $thumbnailName,
            'file_path' => $step3['file_path'],
            'file_size' => $step3['file_size'] ?? null,
            'file_description' => $step3['file_description'] ?? null,
            'download_date' => $step3['embargo_date'] ?? null,
            'download_permission' => isset($step3['download_permission']) ? (bool) $step3['download_permission'] : false,
        ]);

        // Attach authors
        foreach ($step1['authors'] as $authorData) {
            $author = Author::firstOrCreate([
                'firstname' => $authorData['firstname'],
                'lastname' => $authorData['lastname'],
            ]);

            $paper->authors()->attach($author->id);
        }

        // Attach keywords
        if (!empty($step2['keywords'])) {
            $keywordIds = [];
            foreach (array_unique($step2['keywords']) as $keyword) {
                $key = Keyword::firstOrCreate(['name' => $keyword]);
                $keywordIds[] = $key->id;
            }
            $paper->keywords()->syncWithoutDetaching($keywordIds);
        }

        session()->forget('submission');

        return redirect()->route('submission.step1')->with('success', 'Paper submitted successfully!');
    }

    public function show($id)
{
    $paper = Paper::with(['authors', 'keywords'])->findOrFail($id);
    $paper->increment('views'); // 👈 count as view

    return view('submission.show', compact('paper'));
}


}
