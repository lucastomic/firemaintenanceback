<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validateRegistration($request);

        $user = $this->createUser($request);
        $token = $this->attemptLogin($request);

        return $token 
            ? response()->json(['token' => $token], 201)
            : response()->json(['error' => 'Could not create user'], 500);
    }

    public function getUser(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['user_not_found'], 404);
            }
            return response()->json(compact('user'));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $token = $this->attemptLogin($request);
        return $token
            ? response()->json(['token' => $token], 200)
            : response()->json(['error' => 'Unauthorized'], 401);
    }

    private function validateRegistration(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'photo' => 'required|string',
        ])->validate();
    }

    private function createUser(Request $request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $request->photo,
            'password' => Hash::make($request->password),
        ]);
    }

    private function attemptLogin(Request $request)
    {
        return JWTAuth::attempt($request->only('email', 'password'));
    }
}
