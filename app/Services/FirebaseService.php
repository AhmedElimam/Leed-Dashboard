<?php



namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class FirebaseService
{
    protected $auth;

    public function __construct()
    {
        $this->auth = (new Factory)
            ->withServiceAccount(config('firebase.credentials'))
            ->createAuth();
    }

    public function getUserByIdToken($idToken)
    {
        return $this->auth->verifyIdToken($idToken);
    }

    public function createUser($email, $password)
    {
        return $this->auth->createUser([
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function getUser($uid)
    {
        return $this->auth->getUser($uid);
    }
}
