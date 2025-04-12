<?php

namespace App\Http\Controllers;

use App\Models\Phobia;
use Illuminate\Http\Request;

class PhobiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phobias = Phobia::latest()->get();
        $data = ['phobias' => $phobias];
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
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'phobia_name' => 'required|string',
            'description' => 'required|string',
            'progress' => 'required|integer'
        ]);

        $phobia = Phobia::create($validated); // Use correct model name
        return response()->json(['message' => 'added', 'data' => $phobia], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $phobia = Phobia::find($id);
        if ($phobia) {
            return response()->json($phobia);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $phobia = Phobia::find($id);
        if ($phobia) {
            return response()->json($phobia);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $phobia = Phobia::find($id);
        if (!$phobia) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|integer|exists:users,id',
            'phobia_name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'progress' => 'sometimes|integer'
        ]);

        $phobia->update($validated);
        return response()->json($phobia);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $phobia = Phobia::find($id);
        if (!$phobia) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $phobia->delete();
        return response()->json(['message' => 'deleted']);
    }
}
