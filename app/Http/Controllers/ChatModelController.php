<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\SmileModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\NewMessageAdded;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\Util\Str;

class ChatModelController extends Controller
{
    public function index($id)
    {
        $smiles = SmileModel::get();
        $user = User::find($id);
        $chat = $user->chat()->find(Auth::user());
        $userChats = Message::where('chat_id','=',$chat->pivot->chat_id)->get();

        return view('chat',compact('user','userChats','smiles'));
    }

    public function changeMess(Request $request)
    {
        $message = Message::find($request->get('id'));
        $message->content = $request->get('message');
        $message->save();

        return redirect()->back();
    }
    public function deleteMessage($id)
    {
        $message = Message::find($id)->delete();

        return $message;
    }
    public function image($id)
    {
        return Message::findOrFail($id);
    }

    public function createChat(Request $request)
    {
        $token = \Illuminate\Support\Str::random(20);
        $user_sec_id = User::find($request->get('user_id'));
        $user_first_id = User::find($request->get('users_id'));
        $user_first_id->chat()->attach($user_sec_id->id,['chat_id' => $token]);
        $user_sec_id->chat()->attach($user_first_id->id,['chat_id' => $token]);

        return $user_sec_id;
    }

    public function postImage(Request $request)
    {
        $image = $request->file('image')->store('uploads','public');
        $message = Message::create([
            'chat_id' => $request->get('chat_id'),
            'author_id' => $request->get('user_id'),
            'content' => $image,
        ]);

        return redirect()->back();
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

    public function postSmileMessage(Request $request, $id)
    {
        $smile = SmileModel::find($id);
        $message = Message::create([
           'chat_id' => $request->get('chat_id'),
           'author_id' => $request->get('user_id'),
           'content' => $smile->content,
        ]);

        return $message;
    }
}
