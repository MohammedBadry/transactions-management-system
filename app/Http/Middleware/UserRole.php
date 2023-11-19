<?php

namespace App\Http\Middleware;

use Closure;

class UserRole {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $role) {
		if (!auth()->user()->role($role)) {
            if(request()->segment(1)!='api') {
                return redirect(url('/need/permission'));
            } else {
                return response()->json(['status' => false, 'message' => "Need permission", 'data' => null]);
            }
		}
		return $next($request);
	}
}
