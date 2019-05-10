<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect($this->redirectTo());
        }

        return $next($request);
    }

    /**
     * 定义用户验证成功后跳转到首页
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    protected function redirectTo()
    {
        return url('homepage');
    }
}
