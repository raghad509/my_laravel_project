<?php

namespace App\Http\Controllers;

use App\Models\DailyNote; // Add missing model import
use Illuminate\Http\Request;

class DailyNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daily_notes = DailyNote::latest()->get();
        $data = ['daily_notes' => $daily_notes];
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'date' => 'required|date',
            'feeling' => 'required|string',
            'description' => 'required|string'
        ]);

        $daily_note = DailyNote::create($validated); // Use correct model name
        return response()->json(['message' => 'added', 'data' => $daily_note], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $daily_note = DailyNote::find($id);
        if ($daily_note) {
            return response()->json($daily_note);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $daily_note = DailyNote::find($id);
        if ($daily_note) {
            return response()->json($daily_note);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $daily_note = DailyNote::find($id);
        if (!$daily_note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|integer|exists:users,id',
            'date' => 'sometimes|date',
            'feeling' => 'sometimes|string',
            'description' => 'sometimes|string'
        ]);

        $daily_note->update($validated);
        return response()->json($daily_note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $daily_note = DailyNote::find($id);
        if (!$daily_note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $daily_note->delete();
        return response()->json(['message' => 'deleted']);
    }
}
