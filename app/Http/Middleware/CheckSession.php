<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (!session('userEmail')) {
            Auth::logout();
            return redirect(url('/auth/login'))->withErrors(['email' => 'Anda belum login !, silahkan login untuk dapat mengakses halaman user']);
        }
        return $next($request);
    }
}
