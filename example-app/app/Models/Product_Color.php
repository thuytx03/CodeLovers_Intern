<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Color extends Model
{
    use HasFactory;
    protected $table='product_color';
    public function colors()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

}
