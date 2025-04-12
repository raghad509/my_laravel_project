<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::latest()->get();
        $data = ['notifications' => $notifications];
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
            'content' => 'required|string',
            'sent_at' => 'required|date',
            'is_read' => 'required|boolean'
        ]);

        $notification = Notification::create($validated); // Use correct model name
        return response()->json(['message' => 'added', 'data' => $notification], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notification =Notification::find($id);
        if ($notification) {
            return response()->json($notification);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            return response()->json($notification);
        }
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|integer|exists:users,id',
            'content' => 'sometimes|string',
            'sent_at' => 'sometimes|date',
            'is_read' => 'sometimes|boolean'
        ]);

        $notification->update($validated);
        return response()->json($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $notification->delete();
        return response()->json(['message' => 'deleted']);
    }
}
