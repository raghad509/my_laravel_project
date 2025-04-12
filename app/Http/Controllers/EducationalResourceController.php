<?php

namespace App\Http\Controllers;

use App\Models\EducationalResource;
use Illuminate\Http\Request;

class EducationalResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educational_resources = EducationalResource::latest()->get();
        $data = ['educational_resources' => $educational_resources];
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
            'tip_id'=>'required|integer|exists:tips,id',
            'title'=>'required|string',
            'description'=>'required|string',
            'link'=>'required|string'
        ]);
        $educational_resource = EducationalResource::create($validated); // Use correct model name
        return response()->json(['message' => 'added', 'data' => $educational_resource], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $educational_resource = EducationalResource::find($id);
        if ($educational_resource) {
            return response()->json($educational_resource);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $educational_resource = EducationalResource::find($id);
        if ($educational_resource) {
            return response()->json($educational_resource);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $educational_resource = EducationalResource::find($id);
        if (!$educational_resource) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $validated = $request->validate([
            'tip_id'=>'sometimes|integer|exists:tips,id',
            'title'=>'sometimes|string',
            'description'=>'sometimes|string',
            'link'=>'sometimes|string'
        ]);

        $educational_resource->update($validated);
        return response()->json($educational_resource);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $educational_resource = EducationalResource::find($id);
        if (!$educational_resource) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $educational_resource->delete();
        return response()->json(['message' => 'deleted']);
    }
}
