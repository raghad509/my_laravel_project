<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questionnaires = Questionnaire::latest()->get();
        $data = ['questionnaires' => $questionnaires];
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
            'user_id'=>'required|integer|exists:users,id',
            'date'=>'required|date',
            'anxiety_level'=>'required|integer',
            'stress_level'=>'required|integer',
            'symptoms_frequency'=>'required|string',
            'symptoms_severity'=>'required|string',
            'physical_symptoms'=>'required|text',
            'psychological_symptoms'=>'required|text',
            'triggers'=>'required|text',
            'copying_strategy'=>'required|text',
            'daily_life_impact'=>'required|text',
            'support_needs'=>'required|text',

        ]);
        $questionnaire = Questionnaire::create($validated); // Use correct model name
        return response()->json(['message' => 'added', 'data' => $questionnaire], 201);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $questionnaire = Questionnaire::find($id);
        if ($questionnaire) {
            return response()->json($questionnaire);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $questionnaire = Questionnaire::find($id);
        if ($questionnaire) {
            return response()->json($questionnaire);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $questionnaire = Questionnaire::find($id);
        if (!$questionnaire) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $validated = $request->validate([
            'user_id'=>'sometimes|integer|exists:users,id',
            'date'=>'sometimes|date',
            'anxiety_level'=>'sometimes|integer',
            'stress_level'=>'sometimes|integer',
            'symptoms_frequency'=>'sometimes|string',
            'symptoms_severity'=>'sometimes|string',
            'physical_symptoms'=>'sometimes|text',
            'psychological_symptoms'=>'sometimes|text',
            'triggers'=>'sometimes|text',
            'copying_strategy'=>'sometimes|text',
            'daily_life_impact'=>'sometimes|text',
            'support_needs'=>'sometimes|text',
        ]);

        $questionnaire->update($validated);
        return response()->json($questionnaire);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $questionnaire = Questionnaire::find($id);
        if (!$questionnaire) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $questionnaire->delete();
        return response()->json(['message' => 'deleted']);
    }
}
