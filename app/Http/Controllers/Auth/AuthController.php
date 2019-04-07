<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function profile()
    {
        return view('auth.profile', [
            'staff' => $this->staff,
        ]);
    }
}
