<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('admin/login')->with(['alert' => 'error', 'message' => 'Kindly Login First']);
        }
        if(Auth()->user()->role != 'admin'){
            return redirect('admin/login')->with(['alert' => 'error', 'message' => 'Kindly Login First']);
        }
        return $next($request);
    }
}