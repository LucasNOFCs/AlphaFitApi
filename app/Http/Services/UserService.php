<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function index()
    {
        return User::all();
    }

    public function show(int $id)
    {
        return User::findOrFail($id);
    }

    public function store(array $data)
    {
        return User::create($data);
    }

    public function update(int $id, array $data)
    {
        $user = User::findOrFail($id);

        $user->update($data);

        return $user;
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        return $user->delete();
    }
}