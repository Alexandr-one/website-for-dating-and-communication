<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'age',
        'date_of_birth',
        'image',
        'sex',
        'country',
        'town',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function liked(){
        return $this->belongsToMany(User::class,'like_user','user_compliment_id','user_liked_id');
    }
    public function zodiac(){
        return $this->belongsToMany(ZodiacModel::class,'zodiac_users','user_id','zodiac_id');
    }
    public function chat(){
        return $this->belongsToMany(User::class,'user_chat','user_first','user_second')->withPivot('chat_id');
    }

}
