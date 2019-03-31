<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     *  The authenticated user.protected
     *
     * @var \App\Models\Staff|null
     */
    protected $staff;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->staff = Auth::user();

            view()->share('staff', $this->staff);

            return $next($request);
        });
    }
}
