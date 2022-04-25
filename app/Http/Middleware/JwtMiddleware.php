<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use App\Traits\ApiResponser;

class JwtMiddleware extends BaseMiddleware
{
    use ApiResponser;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                // return response()->json(['status' => 'Token is Invalid']);
                return $this->errorResponse('Token is Invalid', 403);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                // return response()->json(['status' => 'Token is Expired'], 403);
                return $this->errorResponse('Token is Expired', 403);
            }else{
                // return response()->json(['status' => 'Authorization Token not found']);
                return $this->errorResponse('Authorization Token not found', 403);
            }
        }
        return $next($request);
    }
}
