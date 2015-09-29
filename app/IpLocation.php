<?php
namespace App;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
class IpLocation{
	
	public static function detectAllLocation(){
		$views = View::all();
		
		foreach($views as $view){
			if ($view->location != "") continue;
			$ip = $view->ip;
			$client = new Client([
					'base_uri' => 'http://ip.taobao.com',
					'timeout'  => 5.0,
			]);
		
			try {
				$response = $client->request('GET', '/service/getIpInfo.php', ['query' => "ip=$ip" ]);
				$body = json_decode($response->getBody());
		
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
			} catch (Exception $e) {
				Log::warn($e->getMessage());
			}
		
			$view->save();
		}
	}
}