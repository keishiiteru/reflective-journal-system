<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        if($search){
            $entries = Entry::where('user_id',Auth::user()->id)
                             ->whereAny([
                                'title',
                                'content',
                             ], 'LIKE', "%{$search}%")
                            ->orderBy('created_at', 'DESC')
                            ->get();
        }else{
            $entries = Entry::where('user_id',Auth::user()->id)
                            ->orderBy('created_at','DESC')
                            ->get();
        }

        return response()->json(['entries' => $entries],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $entry = Entry::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json(['message' => 'Entry created successfully!', 'entry' => $entry], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $entry = Entry::find($id);

        return response()->json(['entry' => $entry],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $entry = Entry::findOrFail($id); // Find the entry by ID

        if ($entry->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $entry->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

         return response()->json(['message' => 'Entry updated successfully!', 'entry' => $entry], 201);
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
