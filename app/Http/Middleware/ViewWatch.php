<?php

namespace App\Http\Middleware;

use Closure;
use App\View;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class ViewWatch {
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @param \Closure $next        	
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		$response = $next ( $request );
		
		$ignore = [
		];
		
		if (array_search($request->ip(), $ignore) == false){
			$ip = $request->ip();
			$path = $request->path();
			
			$view = new View();
			$view->ip = $ip;
			$view->url = $path;
			
			$view->save();
		}
		
		return $response;
	}
}
