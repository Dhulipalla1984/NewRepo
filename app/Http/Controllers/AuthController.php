<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
   // Register a new user
   public function register(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users',
           'password' => 'required|string|min:8',
       ]);

       if ($validator->fails()) {
           return response()->json(['error' => $validator->errors()], 422);
       }

       $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
       ]);

       $token = $user->createToken('Personal Access Token')->accessToken;

       return response()->json(['token' => $token], 200);
   }

   // Login a user and generate an access token
   public function login(Request $request)
   {
       $credentials = $request->only('email', 'password');

       if (!Auth::attempt($credentials)) {
           return response()->json(['error' => 'Unauthorized'], 401);
       }

       $user = Auth::user();
       $token = $user->createToken('Personal Access Token')->accessToken;

       return response()->json(['token' => $token], 200);
   }

   // Return the authenticated user's details
   public function user(Request $request)
   {
       return response()->json(Auth::user(), 200);
   }

   // Logout a user and revoke their access token
   public function logout(Request $request)
   {
       $request->user()->token()->revoke();

       return response()->json(['message' => 'Successfully logged out'], 200);
   }
}
