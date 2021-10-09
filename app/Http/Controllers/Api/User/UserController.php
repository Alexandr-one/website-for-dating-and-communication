<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function image($id)
    {

        return Message::findOrFail($id);
    }

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

    public function postMessage(Request $request)
    {
        $message = Message::create([
            'chat_id' => $request->get('chat_id'),
            'author_id' => $request->get('user_id'),
            'content' => $request->get('text'),
        ]);
        return $message;
    }
}
