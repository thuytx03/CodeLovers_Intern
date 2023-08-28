<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Role extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
    protected $casts = [
        'deleted_at' => 'datetime',
    ];
    public function user(){
        return $this->hasMany(User::class);
    }
}
