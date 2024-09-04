<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Make sure to import the User model
use Illuminate\Support\Facades\Hash; // Import Hash facade
use Validator;

class UserController extends Controller
{
    public function index()
    {
        // Retrieve all users from the database
        $users = User::all();

        // Return the user data as a JSON response
        return response()->json([
            'message' => 'sucess',
            'user' => $users
        ], 200);
        // Pass the users data to the view
       // return view('users.index', compact('users'));
    }
    // GET /api/articles/{id}
    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        dd($token);die;
if (!$token) {
    return response()->json(['message' => 'Token generation failed'], 500);
}

return response()->json(['token' => $token], 200);
    }
}
