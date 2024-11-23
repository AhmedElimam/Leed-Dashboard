<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class FireController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $firebase = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/service-account.json'));

        $this->auth = $firebase->createAuth();
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($request->email, $request->password);

            return response()->json([
                'token' => $signInResult->idToken(),
                'message' => 'Login successful',
            ], 200);
        } catch (\Kreait\Firebase\Exception\Auth\AuthError $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'phone_number' => ['required', 'regex:/^\+\d{1,15}$/'],
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ]);

        try {
            $user = $this->auth->createUser([
                'email' => $request->email,
                'password' => $request->password,
                'phoneNumber' => $request->phone_number,
            ]);

            $this->auth->updateUser($user->uid, [
                'displayName' => $request->first_name . ' ' . $request->last_name,
            ]);

            $signInResult = $this->auth->signInWithEmailAndPassword($request->email, $request->password);

            return response()->json([
                'user' => $user,
                'token' => $signInResult->idToken(),
                'message' => 'Registration successful',
            ], 200);
        } catch (\Kreait\Firebase\Exception\Auth\AuthError $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }
}


