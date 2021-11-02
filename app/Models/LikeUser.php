<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeUser extends Model
{
    use HasFactory;

    protected $table = 'like_user';

    public function firstUser()
    {
        return $this->hasMany(User::class,'id','user_compliment_id');
    }

    public function secondUser()
    {
        return $this->hasMany(User::class,'id','user_liked_id');
    }
}
