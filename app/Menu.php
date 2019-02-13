<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $fillable = [
		'name', 'price', 'photo', 'type_id'
	];

	public function orders(){
		return $this->belongsToMany(Order::class);
	}

	public function type(){
		return $this->belongsTo(MenuType::class);
	}
}
