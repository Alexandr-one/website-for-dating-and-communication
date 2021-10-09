<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function show($id)
    {

        return User::findOrFail($id);
    }

    public function like($user_id,$id)
    {
        $userCompliment = User::find($user_id);
        $userCompliment->liked()->attach($id);

        return $userCompliment;
    }

    public function delike($user_id,$id)
    {
        $userCompliment = User::find($user_id);
        $userCompliment->liked()->detach($id);

        return $userCompliment;
    }


}
