<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = base64_decode($request->get('api_token'));

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not authorized'
            ], 400);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch (ExpiredException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token has expired,try login again.'
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not authorized'
            ], 400);
        }
        $user = User::find($credentials->sub);
        $request->auth = $user;
        return $next($request);
    }
}
