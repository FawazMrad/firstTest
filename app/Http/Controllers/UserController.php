<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;


class UserController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return response()->json($this->userService->getAllUsers());
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate(['name' => 'required', 'email' => 'required|unique:users', 'password' => 'required',]);
            $user = $this->userService->createUser($validated);
            return response()->json(['message' => 'User created', 'user' => $user]);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            return response()->json($this->userService->getUserById($id));
        } catch (Exception $e) {
            return response()->json(['message'=>$e->getMessage(),'userId'=>$id],404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate(['name' => 'nullable', 'email' => 'nullable', 'password' => 'nullable',]);
            $user = $this->userService->updateUser($validated, $id);
            return response()->json(['message' => 'User updated', 'user' => $user]);
        }catch (Exception $e) {
            return response()->json(['message'=>$e->getMessage(),'userId'=>$id],404);
        }
    }

    public function destroy($id)
    {
        try{
        $this->userService->deleteUser($id);
        return response()->json(['message' => 'User deleted']);
    }catch (Exception $e){
            return response()->json(['message'=>$e->getMessage(),'userId'=>$id],404);
        }
    }
}
