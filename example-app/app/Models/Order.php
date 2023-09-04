<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Order extends Model
{
    use HasFactory,Notifiable;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function order_details()
    {
        return $this->hasMany(Order_Detail::class);
    }
}
