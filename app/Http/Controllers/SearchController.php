<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paper;
class SearchController extends Controller
{
    public function search(Request $request)
    {
        $field = $request->input('field');
        $query = $request->input('query');

        $papers = Paper::query();

        if ($field === 'title') {
            $papers->where('title', 'like', "%{$query}%");
        } elseif ($field === 'author') {
            $papers->whereHas('authors', function ($q) use ($query) {
                $q->where('firstname', 'like', "%{$query}%")
                  ->orWhere('lastname', 'like', "%{$query}%");
            });
        } elseif ($field === 'abstract') {
            $papers->where('abstract', 'like', "%{$query}%");
        } elseif ($field === 'subject') {
            $papers->where('description', 'like', "%{$query}%"); // assuming subject is in 'description'
        } else {
            $papers->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('abstract', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhereHas('authors', function ($q2) use ($query) {
                      $q2->where('firstname', 'like', "%{$query}%")
                         ->orWhere('lastname', 'like', "%{$query}%");
                  });
            });
        }


        $results = $papers->with(['authors', 'keywords'])->paginate(10);

        return view('search.results', compact('results', 'query', 'field'));
    }
}
