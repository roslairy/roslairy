<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model{
	public static function getAll($perPage = 15){
		return self::orderBy('created_at', 'desc')->paginate($perPage);
	}
}
