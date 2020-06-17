<?php

namespace App\Http\Controllers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    private $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public static function jwt_assign_token(User $user)
    {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60 * 60 // Expiration time
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will 
        // be used to decode the token in the future.
        return base64_encode(JWT::encode($payload, env('JWT_SECRET')));
    }

    public function login(User $user)
    {
        $this->validate($this->request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);
        $user = User::where('email', $this->request->input('email'))->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email does not exist.'
            ], 400);
        }
        // Verify the password and generate the token
        if (Hash::check($this->request->input('password'), $user->password)) {
            return response()->json([
                'status' => 'success',
                'name' => $user->name,
                'message' => 'Login Successfully',
                'access_token' => $this->jwt_assign_token($user)
            ], 200);
        }
        // Bad Request response
        return response()->json([
            'status' => 'error',
            'message' => 'Email and Password did not match.'
        ], 400);
    }
}
