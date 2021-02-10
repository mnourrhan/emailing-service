<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class CheckHeaderToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->get('api_token') === env('API_TOKEN')) {
            return $next($request);
        }

        return failureResponse(Response::HTTP_UNPROCESSABLE_ENTITY, __('API token is invalid!'));
    }
}
