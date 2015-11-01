<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model {
	
	protected static $paginate = 5;
	
	public static function getAll($perPage = 5){
		return self::orderBy('created_at', 'desc')->paginate($perPage);
	}
	
	public static function getWhereCategory($category, $perPage = 6){
		$result = self::where('category', '=', $category)->orderBy('created_at', 'desc');
		return $result->paginate($perPage);
	}
	
	public function comments(){
		return $this->hasMany('App\Comment');
	}
}
