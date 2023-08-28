<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name'];
    protected $table='sizes';
    public function product(){
        return $this->belongsToMany(Product::class);
    }
}
