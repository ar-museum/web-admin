<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        #$dd = $this->staff->can("delete", []);
        return view('dashboard.index', [
            'test' => 'msg',
        ]);
    }
}