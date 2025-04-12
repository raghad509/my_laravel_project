<?php

namespace App\Http\Controllers;

use App\Models\DientAndHabit;
use Illuminate\Http\Request;

class DietAndHabitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diet_and_habit = DientAndHabit::latest()->get();
        $data = ['diet_and_habits' => $diet_and_habit];
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
            'date' => 'required|date',
            'diet_description' => 'required|string',
            'bad_habits' => 'required|string'
        ]);

        $diet_and_habit = DientAndHabit::create($validated); // Use correct model name
        return response()->json(['message' => 'added', 'data' => $diet_and_habit], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $diet_and_habit = DientAndHabit::find($id);
        if ($diet_and_habit) {
            return response()->json($diet_and_habit);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $diet_and_habit = DientAndHabit::find($id);
        if ($diet_and_habit) {
            return response()->json($diet_and_habit);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $diet_and_habit= DientAndHabit::find($id);
        if (!$diet_and_habit) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|integer|exists:users,id',
            'date' => 'sometimes|date',
            'diet_description' => 'sometimes|string',
            'bad_habits' => 'sometimes|string'
        ]);

        $diet_and_habit->update($validated);
        return response()->json($diet_and_habit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $diet_and_habit = DientAndHabit::find($id);
        if (!$diet_and_habit) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $diet_and_habit->delete();
        return response()->json(['message' => 'deleted']);
    }
}
