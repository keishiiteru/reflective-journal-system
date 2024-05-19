<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        if($search){
            $entries = Entry::where('title', 'LIKE', "%{$search}%")
                            ->orWhere('content', 'LIKE', "%{$search}%")
                            ->orderBy('created_at', 'DESC')
                            ->get();
        }else{
            $entries = Entry::orderBy('created_at','DESC')->get();
        }

        return response()->json(['entries' => $entries],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $entry = Entry::create([
            'user_id' => 0,
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json(['message' => 'Entry created successfully!', 'entry' => $entry], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $entry = Entry::findOrFail($id);
        $entry->delete();

        return response()->json(['message' => 'Entry deleted successfully!'], 201);

    }
}
