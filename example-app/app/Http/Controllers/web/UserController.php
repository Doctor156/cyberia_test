<?php

namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function authenticate(AuthRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/admin');
        }

        return redirect('/login')->withErrors('no such user');
    }
}
