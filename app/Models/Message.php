<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['chat_id','author_id','content','status'];

    public function user()
    {
        return $this->hasMany(User::class,'id','author_id');
    }

}
