<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;

class TipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tips = Tip::latest()->get();
        $data = ['tips' => $tips];
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'content'=>'required|string'
        ]);
        $tip = Tip::create($validated); // Use correct model name
        return response()->json(['message' => 'added', 'data' => $tip], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tip= Tip::find($id);
        if ($tip) {
            return response()->json($tip);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tip = Tip::find($id);
        if ($tip) {
            return response()->json($tip);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tip = Tip::find($id);
        if (!$tip) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $validated = $request->validate([
            'content'=>'sometimes|string'
        ]);

        $tip->update($validated);
        return response()->json($tip);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tip = Tip::find($id);
        if (!$tip) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $tip->delete();
        return response()->json(['message' => 'deleted']);
    }

}
