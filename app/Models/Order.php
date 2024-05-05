<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderproduct() {
        return $this->hasMany(OrderProduct::class);
    }

    public function products() {
        return $this->hasManyThrough(Product::class, OrderProduct::class);
    }
}
