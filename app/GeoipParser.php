<?php
namespace App;

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
class GeoipParser{
	public static function parse($ip){
		
		$reader = new Reader(storage_path("geoip/city.mmdb"));
		
		$address = "";
		
		try {
			$record = $reader->city($ip);
			$address = $record->country->names["zh-CN"]."-".$record->city->names["zh-CN"];
		} 
		catch (AddressNotFoundException $e) {
			$address = "无记录";
		}
		
		return $address;
	}
}