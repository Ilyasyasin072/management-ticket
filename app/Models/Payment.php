<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order() {
        return $this->belongsTo(Orders::class, 'order_id')->where('status', 1);
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePaymentUser($query) {
        return $query->innerJoin('orders','orders.id', '=', 'payments.order_id')->get();
    }
}
