<?php

namespace App\Http\Controllers;

use App\Models\RelaxationExercise;
use Illuminate\Http\Request;

class RelaxationExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relaxation_exercises = RelaxationExercise::latest()->get();
        $data = ['relaxation_exercises' => $relaxation_exercises];
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
            'title' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'date_assigned' => 'required|date'
        ]);

        $relaxation_exercise = RelaxationExercise::create($validated); // Use correct model name
        return response()->json(['message' => 'added', 'data' => $relaxation_exercise], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $relaxation_exercise = RelaxationExercise::find($id);
        if ($relaxation_exercise) {
            return response()->json($relaxation_exercise);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $relaxation_exercise = RelaxationExercise::find($id);
        if ($relaxation_exercise) {
            return response()->json($relaxation_exercise);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $relaxation_exercise = RelaxationExercise::find($id);
        if (!$relaxation_exercise) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $validated = $request->validate([
           'user_id' => 'sometimes|integer|exists:users,id',
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'duration' => 'sometimes|integer',
            'date_assigned' => 'sometimes|date'
        ]);

        $relaxation_exercise->update($validated);
        return response()->json($relaxation_exercise);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $relaxation_exercise = RelaxationExercise::find($id);
        if (!$relaxation_exercise) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $relaxation_exercise->delete();
        return response()->json(['message' => 'deleted']);
    }
}
