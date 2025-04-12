<?php

namespace App\Http\Controllers;

use App\Models\SpecialistCommunication;
use Illuminate\Http\Request;

class SpecialistCommunicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialist_communications = SpecialistCommunication::latest()->get();
        $data = ['specialist_communications' => $specialist_communications];
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
            'specialist_id' => 'required|integer|exists:users,id',
            'communication_date' => 'required|date',
            'message' => 'required|string'
        ]);
        $specialist_communication = SpecialistCommunication::create($validated); // Use correct model name
        return response()->json(['message' => 'added', 'data' => $specialist_communication], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $specialist_communication = SpecialistCommunication::find($id);
        if ($specialist_communication) {
            return response()->json($specialist_communication);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $specialist_communication = SpecialistCommunication::find($id);
        if ($specialist_communication) {
            return response()->json($specialist_communication);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $specialist_communication = SpecialistCommunication::find($id);
        if (!$specialist_communication) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|integer|exists:users,id',
            'specialist_id' => 'sometimes|integer|exists:users,id',
            'communication_date' => 'sometimes|date',
            'message' => 'sometimes|string'
        ]);

        $specialist_communication->update($validated);
        return response()->json($specialist_communication);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $specialist_communication = SpecialistCommunication::find($id);
        if (!$specialist_communication) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $specialist_communication->delete();
        return response()->json(['message' => 'deleted']);
    }
}
