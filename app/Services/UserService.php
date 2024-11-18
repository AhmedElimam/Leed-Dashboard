<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function createUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function updateUser(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function getAllUsers($perPage = 10)
    {
        return User::paginate($perPage);
    }

    public function deleteUser(User $user): bool
    {
        return $user->delete();
    }
}
