<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuType extends Model
{
	public $timestamps = false;
	
    protected $fillable = [
		'name'
	];

	public function items(){
		return $this->hasMany(Menu::class, 'type_id');
	}
}
