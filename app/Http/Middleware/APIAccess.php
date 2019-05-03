<?php

namespace App\Http\Middleware;

use Closure;

class APIAccess
{
    private $contentType = "application/json";
    private $apiKey      = "98544-15s78-99srq-wn655-jk25s";

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('Content-Type') != $this->contentType || !$request->has('deviceId') || !$request->has('token'))
        {
            return $this->restrictedAccess();
        }

        $deviceId = $request->get('deviceId');
        $token    = $request->get('token');

        if ($token != $this->createToken($deviceId))
        {
            return $this->invalidRequest();
        }

        return $next($request);
    }

    private function restrictedAccess()
    {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    private function invalidRequest()
    {
        return response()->json(['message' => 'INVALID_REQUEST'], 404);
    }

    private function createToken($deviceId)
    {
        return sha1($deviceId . $this->apiKey);
    }
}
