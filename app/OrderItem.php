<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
		'order_id', 'item_id', 'quantity'
	];

    public function order()
    {
        return $this->belongTo(Order::class, 'order_id');
    }

    public function items()
    {
        return $this->hasMany(Menu::class, 'id', 'item_id');
    }
}
