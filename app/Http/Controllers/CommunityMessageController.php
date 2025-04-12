<?php

namespace App\Http\Controllers;

use App\Models\CommunityMessage;
use Illuminate\Http\Request;

class CommunityMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $community_messages = CommunityMessage::latest()->get();
        $data = ['community_messages' => $community_messages];
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
            'sender_id' => 'required|integer|exists:users,id',
            'receiver_id' => 'required|integer|exists:users,id',
            'message' => 'required|string',
            'sent_at' => 'required|date',
            'is_read' => 'required|boolean'
        ]);

        $community_message = CommunityMessage::create($validated); // Use correct model name
        return response()->json(['message' => 'added', 'data' => $community_message], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $community_message = CommunityMessage::find($id);
        if ($community_message) {
            return response()->json($community_message);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $community_message = CommunityMessage::find($id);
        if ($community_message) {
            return response()->json($community_message);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $community_message = CommunityMessage::find($id);
        if (!$community_message) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $validated = $request->validate([
            'sender_id' => 'sometimes|integer|exists:users,id',
            'receiver_id' => 'sometimes|integer|exists:users,id',
            'message' => 'sometimes|string',
            'sent_at' => 'sometimes|date',
            'is_read' => 'sometimes|boolean'
        ]);

        $community_message->update($validated);
        return response()->json($community_message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $community_message = CommunityMessage::find($id);
        if (!$community_message) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $community_message->delete();
        return response()->json(['message' => 'deleted']);
    }
}
