<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'user_id'

    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'image',
    ];
    public function user(){

        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}