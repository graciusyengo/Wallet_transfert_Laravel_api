<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    $users = User::all();

        return response()->json([
            'success' => true,
            'data' => $users
        ], 200);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


      $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:8',
        ]);

           $user = User::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur créé avec succès',
            'data' => $user
        ], 201);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'phone' => 'sometimes|required|string|max:20|unique:users,phone,' . $id,
            'password' => 'sometimes|required|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur mis à jour avec succès',
            'data' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)

    {
        $user = User::findOrFail($id);
        $user->delete();


        return response()->json([
            'success' => true,
            'message' => 'Utilisateur supprimé avec succès'
        ], 200);
    }
}
