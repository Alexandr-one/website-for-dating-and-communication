<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatUserModel extends Model
{
    use HasFactory;

    protected $table = 'user_chat';
    protected $fillable = ['id','chat_id','user_first','user_second','status'];

    public function message()
    {
        return $this->hasMany(Message::class,'chat_id','chat_id');
    }

    public function firstUser()
    {
        return $this->hasMany(User::class,'id','user_first');
    }

    public function secondUser()
    {
        return $this->hasMany(User::class,'id','user_second');
    }
}
