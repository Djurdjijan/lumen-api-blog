<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function register_user(Request $request)
    {

        $validateData = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8',],
        ]);
        if ($validateData->fails()) {
            return response()->json($validateData->errors(), 400);
        }
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return response()->json([
            'status' => 'success',
            'name' => $user->name,
            'message' => 'User created successfully',
            'access_token' => AuthController::jwt_assign_token($user)
        ], 200);
    }

}
