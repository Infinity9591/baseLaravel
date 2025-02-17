<?php

namespace App\Http\Middleware;

use App\Helpers\JWTHelper;
use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $whitelist = ['/', '/site/login'];

        $isInWhitelist = false;
        foreach ($whitelist as $item) {
            if ('api' . $item === $request->path()) {
                $isInWhitelist = true;
                break;
            }
        }

        if (!$isInWhitelist) {
            try {
                if (request()->bearerToken() != null && request()->bearerToken() != ""){
                    $auth = request()->bearerToken();
                    $verified = JWTHelper::verifyToken($auth);
                    if ($verified  != null && $verified  != ""){
                        $request->request->add(['user' => $verified]);
                        return $next($request);
                    }
                } else {
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
            } catch (\Throwable $th) {
                return response()->json(['error' => 'Bad Request'], 500);
            }
        }
        return $next($request);
    }
}
