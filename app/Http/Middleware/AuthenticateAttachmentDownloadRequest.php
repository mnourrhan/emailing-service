<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AuthenticateAttachmentDownloadRequest
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
        if(Hash::check(env('ENCRYPTION_KEY'), $request->get('token'))){
            return $next($request);
        }

        return failureResponse(Response::HTTP_UNPROCESSABLE_ENTITY, __('token is invalid!'));
    }
}
