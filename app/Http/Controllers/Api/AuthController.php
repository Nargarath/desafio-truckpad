<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use JWTAuth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = JWTAuth::attempt($credentials)) 
        {
            return response()->json(
                [
                    'status' => 'error',
                    'error' => 'Credenciais inválidas'
                ], 403);
        }

        return response()->json(
            [
                'status' => 'success',
                'token' => $token
            ]);
    }

    public function refresh()
    {
        $token = JWTAuth::getToken();
        $newToken = JWTAuth::refresh($token);
        return response()->json([
            'token' => $newToken
        ]);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }

    public function logout()
    {
        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);
        return response()->json([
           'status' => 'success'
        ]);
    }

}
