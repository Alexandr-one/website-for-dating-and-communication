<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatUserModel extends Model
{
    use HasFactory;

    protected $table = 'user_chat';
    protected $fillable = ['id','chat_id','user_first','user_second'];
}
