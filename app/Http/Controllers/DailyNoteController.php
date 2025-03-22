<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daily_notes=DailyNote::latest()->get();
      $data=['daily_notes'=>$daily_notes
    ];
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
        $json=$request->json()->all();
        User::create([
            'user_id'=>$json['user_id'],
           'date'=>$json['date'],
           'feeling'=>$json['feeling'],
           'description'=>$json['description'],
        ]);
        return response()->json('added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $daily_note=DailyNote::find($id);
       if($daily_note){
        return response()->json($daily_note);
       }
       else{
        return response()->json(404);
       }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $daily_note=DailyNote::find($id);
        if($daily_note){
            return response()->json($daily_note);
           }
           else{
            return response()->json(404);
           }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $daily_note=DailyNote::find($id);
        $json=$request->json()->all();
        $DailyNote->update([
            'user_id'=>$json['user_id'],
           'date'=>$json['date'],
           'feeling'=>$json['feeling'],
           'description'=>$json['description'],
        ]);
        return response()->json($daily_note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $daily_note=DailyNote::find($id);
        $daily_note->delete();
        return response()->json('deleted');
    }
}
