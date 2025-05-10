<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
protected $fillable = ['type', 'message', 'order_id', 'read'];

public function order()
{
return $this->belongsTo(Order::class);
}
}