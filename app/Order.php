<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = [
		'order_no', 'customer', 'table_no', 'waiter_id', 'cashier_id', 'status', 'price'
	];

	public function menus(){
		return $this->belongsToMany(Menu::class);
	}

	public function items(){
		return $this->hasMany(OrderItem::class, 'order_id');
	}

	public function waiter(){
		return $this->belongsTo(User::class, 'waiter_id');
	}

	public function cashier(){
		return $this->belongsTo(User::class);
	}
}
