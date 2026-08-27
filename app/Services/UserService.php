<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function index()
    {
        return User::all();
    }

    public function show(string $id)
    {
        return User::findOrFail($id);
    }

    public function store(array $data)
    {
        return User::create($data);
    }

    public function update(string $id, array $data)
    {
        $user = User::findOrFail($id);

        $user->update($data);

        return $user;
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        return $user->delete();
    }
}