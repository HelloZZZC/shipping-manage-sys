<?php

namespace App\Http\Middleware;

use App\Common\Exception\AccessDeniedException;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * @param $request
     * @param Closure $next
     * @param $permission
     * @return mixed
     * @throws AccessDeniedException
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!Auth::user()->can($permission)) {
            throw new AccessDeniedException();
        }

        return $next($request);
    }
}
