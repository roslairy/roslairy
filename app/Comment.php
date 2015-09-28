<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
	
	public function archive() {
		return $this->belongsTo ( 'App\Archive' );
	}
	
	public static function getAll($perPage = 15){
		return self::orderBy('created_at', 'desc')->paginate($perPage);
	}
}
