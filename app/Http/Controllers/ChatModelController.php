<?php

namespace App\Http\Controllers;

use App\Classes\ChatUserStatusEnum;
use App\Classes\MessageStatusEnum;
use App\Http\Requests\ImageRequest;
use App\Models\ChatModel;
use App\Models\ChatUserModel;
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

    public function read($id)
    {
        $user = User::find($id);
        $chat = $user->chat()->find(Auth::user());
        $userChats = Message::where('chat_id','=',$chat->pivot->chat_id)->where('author_id','!=',Auth::user()->id)->get();
        foreach ($userChats as $userChat) {
            $userChat->status = MessageStatusEnum::READ;
            $userChat->save();
        }

        return redirect()->back();
    }

    public function index($id)
    {
        $checkChat = '';
        $smiles = SmileModel::get();
        $user = User::find($id);
        $chat = $user->chat()->find(Auth::user());
        $userChats = Message::where('chat_id','=',$chat->pivot->chat_id)->get();
        $userChatChat = Message::where('chat_id','=',$chat->pivot->chat_id)->where('author_id','!=',Auth::user()->id)->get();
        foreach($userChatChat as $userChat){
            if($userChat->status == MessageStatusEnum::NEW)
                $checkChat = 'YES';
        }

        return view('chat',compact('user','userChats','smiles','checkChat'));
    }

    public function blockUser(Request $request)
    {
        $user = User::find($request->get('sec_user_id'));
        $status = ChatUserModel::find(Auth::user()->chat()->find($user)->pivot->id);
        $status->status = ChatUserStatusEnum::BLOCK;
        $status->save();

        return redirect()->back();
    }

    public function unBlockUser(Request $request)
    {
        $user = User::find($request->get('sec_user_id'));
        $status = ChatUserModel::find(Auth::user()->chat()->find($user)->pivot->id);
        $status->status = ChatUserStatusEnum::ACTIVE;
        $status->save();

        return redirect()->back();
    }

    public function changeMess(ImageRequest $request)
    {
        $message = Message::findOrFail($request->get('id'));
        $message->content = $request->get('content');
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
        $status = ChatUserStatusEnum::ACTIVE;
        $token = \Illuminate\Support\Str::random(20);
        $user_sec_id = User::find($request->get('user_id'));
        $user_first_id = User::find($request->get('users_id'));
        $user_first_id->chat()->attach($user_sec_id->id,['chat_id' => $token,'status' => $status]);
        $user_sec_id->chat()->attach($user_first_id->id,['chat_id' => $token,'status' => $status]);

        return $user_sec_id;
    }

    public function deleteChat(Request $request)
    {
        $user = User::find($request->get('sec_user_id'));
        $status = ChatUserModel::find(Auth::user()->chat()->find($user)->pivot->id);
        $status->status = ChatUserStatusEnum::DELETE;
        $status->save();

        return redirect()->route('index');
    }

    public function recoverChat(Request $request)
    {
        $id = $request->get('sec_user_id');
        $user = User::find($id);
        $status = ChatUserModel::find(Auth::user()->chat()->find($user)->pivot->id);
        $status->status = ChatUserStatusEnum::ACTIVE;
        $status->save();

        return redirect()->back();
    }
    public function postImage(ImageRequest $request)
    {
        $image = $request->file('content')->store('uploads','public');
        $message = Message::create([
            'chat_id' => $request->get('chat_id'),
            'author_id' => $request->get('user_id'),
            'content' => $image,
            'status' => MessageStatusEnum::NEW,
        ]);

        return redirect()->back();
    }

    public function postMessage(Request $request)
    {
        $message = Message::create([
            'chat_id' => $request->get('chat_id'),
            'author_id' => $request->get('user_id'),
            'content' => $request->get('text'),
            'status' => MessageStatusEnum::NEW,
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
            'status' => MessageStatusEnum::NEW,
        ]);

        return $message;
    }
}
