<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Staff;

class AuthController extends Controller
{
    public function profile()
    {
        $currentStaff = Staff::find($this->staff->staff_id)->withCount(['expositions', 'exhibits', 'categories', 'authors', 'tags'])->first();

        return view('auth.profile', [
            'currentStaff' => $currentStaff,
        ]);
    }

    public function viewSettings()
    {
        return view('auth.settings');
    }
}
