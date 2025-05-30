<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = ['user_id', 'amount', 'quantity', 'order_id', 'recipient', 'status', 'created_at', 'updated_at'];
    protected $guarded = [];
}