<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(AuthRequest $request)
    {
        $credentials = $request->all();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            /** @var User $user */
            $user = Auth::user();

            $user->tokens()->delete();
            $token = $user->createToken('token');

            return response()->json([
                'success' => true,
                'userId' => $user->id,
                'token' => $token,
                'isAdmin' => $user->isAdmin()
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => 'no such user'
        ]);
    }
}
