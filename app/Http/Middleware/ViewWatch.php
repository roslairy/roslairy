<?php

namespace App\Http\Middleware;

use Closure;
use App\View;

class ViewWatch {
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @param \Closure $next        	
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if ($request->ip() != '127.0.0.1' || $request->ip() != '222.20.35.168'){
			$view = new View();
			$view->ip = $request->ip();
			$view->url = $request->path();
			$view->save();
		}
		return $next ( $request );
	}
}
