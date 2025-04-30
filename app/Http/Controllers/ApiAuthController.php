<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\HTTP\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => Hash::make($request->password)])
        );
        $token = JWTAuth::fromUser($user,['user_id' => $user->id]);

        return response()->json([
            'code'  => 201,
            'token' => $this->createNewToken($token),
            'user'  => $user,
            'message' => 'User registered successfully',
        ], 201);

    }

    public function login(Request $request):JsonResponse{
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $loginData = $validator->validated();
        if (!$user = User::where('email',$loginData['email'])->first()) {
            return response()->json([
                'code'  => 200,
                'status'=> 'error',
                'message' => 'User Unauthorized!',
            ], 401);
        }
        if(!HASH::check($loginData['password'], $user->password)){
            return response()->json([  
                'code'  => 200,
                'status'=> 'error',
                'message' => 'User Unauthorized!',
            ], 402);
        }
        $token = JWTAuth::fromUser($user,['user_id'=> $user->id]);

        return response()->json([
            'code'  => 200,
            'token' => $this->createNewToken($token)->withCookie(cookie('access_token', $token, config('jwt.ttl'),'/',null,false,true)),
            'user'  => $user,
            'message' => 'User logged in successfully',
        ], 200);
    }

    public function logout(): JsonResponse
    {
        Auth::logout();
        return response()->json([
            'code' => 200,
            'message' => 'User logged out successfully',
        ], 200);
    }

    public function userProfile(): JsonResponse
    {
        return response()->json([
            'code' => 200,
            'user' => Auth::user(),
        ], 200);
    }

    public function refresh(): JsonResponse
    {
        $token = JWTAuth::parseToken()->refresh();
        return response()->json([
            'code' => 200, 
            'token' => $this->createNewToken($token),
            'message' => 'Token refreshed successfully',
        ], 200);
    }

    protected function createNewToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ]);
    }
}
