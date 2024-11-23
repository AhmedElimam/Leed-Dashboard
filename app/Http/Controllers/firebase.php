<?php

namespace App\Http\Controllers;
use App\Services\FirebaseService;
use Illuminate\Http\Request;

class firebase extends Controller
{


    public function create(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        try {
            $firebase = new FirebaseService();
            $firebaseUser = $firebase->createUser($request->email, $request->password);

            return $this->view('home', ['user' => $firebaseUser]);

        } catch (\Exception $e) {

            return back()->withErrors(['message' => 'Failed to create user. Please try again.']);
        }
    }
    public function show()
    {
        return view('auth.register');
    }
}

