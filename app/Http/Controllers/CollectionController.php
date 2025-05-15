<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Community;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = Collection::with('community')->latest()->paginate(10);
        return view('collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $communities = Community::all();
        return view('collections.create', compact('communities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'community_id' => 'required|exists:communities,id',
        ]);

        Collection::create($request->only('name', 'description', 'community_id'));

        return redirect()->route('collections.index')->with('success', 'Collection created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Collection $collection)
    {
        $collection->load('papers');
        return view('collections.show', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection)
    {
        $communities = Community::all();
        return view('collections.edit', compact('collection', 'communities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collection $collection)
    {

        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'community_id' => 'required|exists:communities,id',
        ]);

        $collection->update($request->only('name', 'description', 'community_id'));

        return redirect()->route('collections.index')->with('success', 'Collection updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return back()->with('success', 'Collection deleted!');
    }
}
