<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='blogs';
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function types()
    {
        return $this->belongsToMany(Type::class, 'blog_types', 'type_id', 'blog_id');
    }
}
