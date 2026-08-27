<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpCache\Store;

class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $users = $this->service->index();
        return $users;
    }

    public function show(string $id)
    {
        $user = $this->service->show($id);
        return $user;
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = $this->service->store($data);
        return $user;
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $request->validated();
        $user = $this->service->update($id, $data);
        return $user;
    }

    public function destroy(string $id)
    {
        $user = $this->service->destroy($id);
        return ["user" => $user, "message" => "User deleted successfully"];
    }
}
