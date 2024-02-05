<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function allUsers()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

     public function show($id)
    {
        $user = User::find($id);
        if($user ) {
            return response()->json($user, 200);
        } else {
            // User not found, return an error response
            return response()->json(['error' => 'user not found'], 404);
        }
    }

    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $credentials = $request->only('email', 'password');

        $user = User::where(['email' => $credentials['email']])->first();

        if (!$user) {
            return response()->json(['error' => 'Email not found'], 401);
        }

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Incorrect password'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('AuthToken');

        return response()->json(['user' => $user, 'access_token' => $token->plainTextToken]);
    }


    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userType' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::create($request->all());
        return response()->json(['user' => $user], 201);
    }

   public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'userType' => 'sometimes|required',
            'address' => 'sometimes|required',
            'phone' => 'sometimes|required',
            'password' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'username' => 'sometimes|required|unique:users,username,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user->update($request->all());
        return response()->json(['user' => $user], 200);
    }


    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
