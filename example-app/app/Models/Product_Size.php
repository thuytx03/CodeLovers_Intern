<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Size extends Model
{
    use HasFactory;
    protected $table='product_size';
    protected $fillable=[
        "product_id","size_id"
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function sizes()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

}
