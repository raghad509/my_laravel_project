<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $users=User::latest()->get();
      $data=['users'=>$users
    ];
    return response()->json($data);  //
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
        $validated=$request->validate
       ([
            'name' =>'required|string',
           'email'=>'required|string',
           'email_verified_at'=>'required|timestamp',
           'password'=>'required|string',
          'active'=>'required|boolean'
        ]);
        $user=User::create($validated);
        return response()->json(['message'=> 'added','data'=>$user],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $user=User::find($id);
       if($user){
        return response()->json($user);
       }

        return response()->json(['message' => 'Note not found'],404);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::find($id);
        if($user){
            return response()->json($user);
           }

            return response()->json(['message' => 'Note not found'],404);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user=User::find($id);
        if(!$user){
            return response()->json(['message' => 'Note not found'],404);
        }
        $validated=$request->validate([
            'name' =>'sometimes|string',
           'email'=>'sometimes|string',
           'email_verified_at'=>'sometimes|timestamp',
           'password'=>'sometimes|string',
          'active'=>'sometimes|boolean'
        ]);
        $user->update($validated);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::find($id);
        if(!$user){
            return response()->json(['message' => 'Note not found'],404);
        }
        $user->delete();
        return response()->json(['message' => 'deleted']);
    }
}
