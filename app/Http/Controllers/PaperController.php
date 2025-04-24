<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Paper;
use App\Models\Author;
use App\Models\Keyword;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaperController extends Controller
{
    public function index(Collection $collection)
    {
        $papers = $collection->papers()->with(['authors', 'keywords'])->latest()->paginate(10);
        return view('papers.index', compact('collection', 'papers'));
    }

    public function create(Collection $collection)
    {
        $allAuthors = Author::orderBy('lastname')->get();
        $allKeywords = Keyword::orderBy('name')->get();
        return view('papers.create', compact('collection', 'allAuthors', 'allKeywords'));
    }

    public function store(Request $request, Collection $collection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'new_authors' => 'nullable|string',
            'existing_authors' => 'nullable|array',
            'existing_authors.*' => 'exists:authors,id',
            'date_of_issue' => 'nullable|date',
            'publisher' => 'nullable|string|max:255',
            'identifier' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:100',
            'language' => 'nullable|string|max:50',
            'new_keywords' => 'nullable|string',
            'existing_keywords' => 'nullable|array',
            'existing_keywords.*' => 'exists:keywords,id',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf|max:10240', // 10MB max
            'file_description' => 'nullable|string|max:255',
            'download_permission' => 'nullable|boolean',
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('papers', 'public');

            $validated['file_path'] = $path;
            $validated['file_size'] = $file->getSize();
        }

        // Create the paper
        $paper = $collection->papers()->create([
            'title' => $validated['title'],
            'date_of_issue' => $validated['date_of_issue'],
            'publisher' => $validated['publisher'],
            'identifier' => $validated['identifier'],
            'type' => $validated['type'],
            'language' => $validated['language'],
            'abstract' => $validated['abstract'],
            'description' => $validated['description'],
            'file_path' => $validated['file_path'],
            'file_size' => $validated['file_size'],
            'file_description' => $validated['file_description'],
            'download_permission' => $request->has('download_permission'),
        ]);

        // Process authors
        $this->processAuthors($paper, $request);

        // Process keywords
        $this->processKeywords($paper, $request);

        return redirect()->route('collections.papers.index', $collection->id)
            ->with('success', 'Paper uploaded successfully.');
    }

    public function show(Collection $collection, Paper $paper)
    {
        $paper->load(['authors', 'keywords']);
        return view('papers.show', compact('collection', 'paper'));
    }

    public function edit(Collection $collection, Paper $paper)
    {
        $paper->load(['authors', 'keywords']);
        $allAuthors = Author::orderBy('lastname')->get();
        $allKeywords = Keyword::orderBy('name')->get();
        return view('papers.edit', compact('collection', 'paper', 'allAuthors', 'allKeywords'));
    }

    public function update(Request $request, Collection $collection, Paper $paper)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'new_authors' => 'nullable|string',
            'existing_authors' => 'nullable|array',
            'existing_authors.*' => 'exists:authors,id',
            'date_of_issue' => 'nullable|date',
            'publisher' => 'nullable|string|max:255',
            'identifier' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:100',
            'language' => 'nullable|string|max:50',
            'new_keywords' => 'nullable|string',
            'existing_keywords' => 'nullable|array',
            'existing_keywords.*' => 'exists:keywords,id',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:10240',
            'file_description' => 'nullable|string|max:255',
            'download_permission' => 'nullable|boolean',
        ]);

        // Handle file upload if new file is provided
        if ($request->hasFile('file')) {
            // Delete old file
            Storage::disk('public')->delete($paper->file_path);

            $file = $request->file('file');
            $path = $file->store('papers', 'public');

            $validated['file_path'] = $path;
            $validated['file_size'] = $file->getSize();
        }

        $paper->update([
            'title' => $validated['title'],
            'date_of_issue' => $validated['date_of_issue'],
            'publisher' => $validated['publisher'],
            'identifier' => $validated['identifier'],
            'type' => $validated['type'],
            'language' => $validated['language'],
            'abstract' => $validated['abstract'],
            'description' => $validated['description'],
            'file_path' => $validated['file_path'] ?? $paper->file_path,
            'file_size' => $validated['file_size'] ?? $paper->file_size,
            'file_description' => $validated['file_description'],
            'download_permission' => $request->has('download_permission'),
        ]);

        // Process authors
        $this->processAuthors($paper, $request);

        // Process keywords
        $this->processKeywords($paper, $request);

        return redirect()->route('collections.papers.index', $collection->id)
            ->with('success', 'Paper updated successfully.');
    }

    public function destroy(Collection $collection, Paper $paper)
    {
        // Delete the file
        Storage::disk('public')->delete($paper->file_path);

        $paper->delete();

        return redirect()->route('collections.papers.index', $collection->id)
            ->with('success', 'Paper deleted successfully.');
    }

    public function download(Collection $collection, Paper $paper)
    {
        if (!$paper->download_permission) {
            abort(403, 'Download permission not granted for this paper.');
        }

        $path = storage_path('app/public/' . $paper->file_path);
        return response()->download($path, Str::slug($paper->title) . '.pdf');
    }

    protected function processAuthors(Paper $paper, Request $request)
    {
        // Sync existing authors
        $paper->authors()->sync($request->input('existing_authors', []));

        // Process new authors
        if ($request->filled('new_authors')) {
            $newAuthors = array_map('trim', explode(';', $request->input('new_authors')));

            foreach ($newAuthors as $authorName) {
                if (empty($authorName)) continue;

                // Split into lastname and firstname
                $parts = array_map('trim', explode(',', $authorName, 2));
                $lastname = $parts[0] ?? '';
                $firstname = $parts[1] ?? '';

                if (!empty($lastname)) {
                    $author = Author::firstOrCreate([
                        'lastname' => $lastname,
                        'firstname' => $firstname,
                    ]);

                    $paper->authors()->syncWithoutDetaching([$author->id]);
                }
            }
        }
    }

    protected function processKeywords(Paper $paper, Request $request)
    {
        // Sync existing keywords
        $paper->keywords()->sync($request->input('existing_keywords', []));

        // Process new keywords
        if ($request->filled('new_keywords')) {
            $newKeywords = array_map('trim', explode(',', $request->input('new_keywords')));

            foreach ($newKeywords as $keywordName) {
                if (!empty($keywordName)) {
                    $keyword = Keyword::firstOrCreate(['name' => $keywordName]);
                    $paper->keywords()->syncWithoutDetaching([$keyword->id]);
                }
            }
        }
    }
}
