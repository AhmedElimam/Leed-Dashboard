<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
public function register(Request $request)
{
$request->validate([
'name' => 'required|string|max:255',
'email' => 'required|string|email|max:255|unique:users',
'password' => 'required|string|min:8',
]);

$user = User::create([
'name' => $request->name,
'email' => $request->email,
'password' => Hash::make($request->password),
]);

$token = $user->createToken('auth_token')->plainTextToken;

return response()->json(['token' => $token, 'user' => $user], 201);
}

public function login(Request $request)
{
$request->validate([
'email' => 'required|string|email',
'password' => 'required|string',
]);

if (!Auth::attempt($request->only('email', 'password'))) {
return response()->json(['message' => 'Invalid credentials'], 401);
}

$user = User::where('email', $request->email)->firstOrFail();
$token = $user->createToken('auth_token')->plainTextToken;

return response()->json(['token' => $token, 'user' => $user], 200);
}

public function profile(Request $request)
{
return response()->json($request->user());
}

public function logout(Request $request)
{
$request->user()->currentAccessToken()->delete();

return response()->json(['message' => 'Logged out successfully']);
}
}
