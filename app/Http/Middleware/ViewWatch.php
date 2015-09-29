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
				'127.0.0.1',
		];
		
		if (array_search($request->ip(), $ignore) == false){
			$ip = $request->ip();
			$path = $request->path();
			$client = new Client([
					'base_uri' => 'http://ip.taobao.com',
					'timeout'  => 2.0,
			]);
					
			$view = new View();
			$view->ip = $ip;
			$view->url = $path;
			
			try {
				$body = json_decode($client->request('GET', '/service/getIpInfo.php', ['query' => "ip=$ip" ])->getBody());

				if ($body->code == 0){
					$country = $body->data->country;
					$area = $body->data->area;
					$region = $body->data->region;
					$city = $body->data->city;
					$isp = $body->data->isp;
					$location = "{$country}-{$area}-{$region}-{$city}-{$isp}";
				}
				else {
					$location = "获取失败";
				}
				
				$view->location = $location;
			} catch (RequestException $e) {
				Log::warn($e->getMessage());
				
				$view->location = "获取失败";
			}
			
			$view->save();
		}
		
		return $response;
	}
}
