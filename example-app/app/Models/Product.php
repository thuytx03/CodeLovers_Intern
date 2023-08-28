<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=[
        "name","slug","image","brand","selling_price","discount_price",
        "quantity","description","like","status","view"
    ];
    public function productImages(){
        return $this->hasMany(Product_Image::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }
    public function colors(){
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id');
    }
    public function sizes(){
        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id');
    }
}
