<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function profile()
    {
        $user = request()->attributes->user;

        return view('auth.profile', [
            'user' => $user,
            'role' => $user->getRoles()->first()->name
        ]);
    }
}
