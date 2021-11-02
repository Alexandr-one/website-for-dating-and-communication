<?php

namespace App\Http\Controllers;

use App\Http\Requests\SmileRequest;
use App\Models\ChatUserModel;
use App\Models\LikeUser;
use App\Models\SmileModel;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $like = DB::table('like_user')->select(DB::raw('count(*) as countLike, user_compliment_id'))
            ->groupBy('user_compliment_id')
            ->orderBy('countLike', 'desc')
            ->get();

        $userMaxLike = User::find($like->first()->user_compliment_id);
        $countMaxLike = $like->first()->countLike;

        return view('admin.main', compact('userMaxLike', 'countMaxLike'));
    }

    public function users(Request $request)
    {
        $getCountry = "";
        $getTown = "";
        $getSex = '';
        $selPar = '';
        $getAgeMinPar = "";
        $getAgeMaxPar = "";
        $getNamePar = '';
        $getSurnamePar = '';
        $users = User::query();
        if($request->get('filter')){
            $users->orderby('age',$request->get('filter'));
            $selPar = $request->get('filter');
        }

        if($request->get('sex')){
            $users->where('sex',$request->get('sex'));
            $getSex = $request->get('sex');
        }

        if($request->get('town')){
            $users->where('town',$request->get('town'));
            $getTown = $request->get('town');
        }

        if($request->get('country')){
            $users->where('country',$request->get('country'));
            $getCountry = $request->get('country');
        }
        if($name = $request->get('nameFilled')){
            $users->where('name','LIKE',"%" . $name . "%");
            $getNamePar = $request->get('nameFilled');
        }

        if($request->get('min_age')){
            $users->where('age','>=', $request->get('min_age'));
            $getAgeMinPar = $request->get('min_age');
        }

        if($request->get('max_age')) {
            $users->where('age', '<=', $request->get('max_age'));
            $getAgeMaxPar = $request->get('max_age');
        }

        if($request->get('surnameFilled')) {
            $users->where('surname', 'LIKE', "%" . $request->get('surnameFilled') . "%");
            $getSurnamePar = $request->get('surnameFilled');
        }
        session()->flash('message', "Найдено {$users->count()} пользователей");
        $users = $users->paginate(10)
            ->withPath('?' . $request->getQueryString());
        $errors = session()->get('changeStatusError');
        $message = session()->get('message');



        return view('admin.users.index', compact('users','errors','selPar','message','getNamePar','getSurnamePar','getAgeMinPar','getAgeMaxPar','getSex','getTown','getCountry'));
    }

    public function chats(Request $request)
    {
        $chats = ChatUserModel::query();
        $getPar = '';
        if($request->get('chat_id')){
            $chats->where('chat_id','=',$request->get('chat_id'));
            $getPar = $request->get('chat_id');
        }
        $chats = $chats->paginate(12)
            ->withPath('?' . $request->getQueryString());
        return view('admin.chats.index', compact('chats','getPar'));
    }

    public function smiles()
    {
        $smiles = SmileModel::get();
        $error = session()->get('deleteSmileError');

        return view('admin.smiles.index', compact('smiles','error'));
    }

    public function messages(Request $request)
    {
        $getPar = '';
        $messages = \App\Models\Message::query();
        if($request->get('chat_id')){
            $messages->where('chat_id','=',$request->get('chat_id'));
            $getPar = $request->get('chat_id');
        }
        $messages = $messages->paginate(12)
            ->withPath('?' . $request->getQueryString());
        return view('admin.messages.index', compact('messages','getPar'));
    }

    public function likes()
    {
        $likes = LikeUser::get();

        return view('admin.likes.index', compact('likes'));
    }

    public function getSmile($id)
    {
        $smile = SmileModel::find($id);

        return $smile;
    }

    public function addSmile(SmileRequest $request)
    {
        $image = $request->file('content')->store('smile','public');
        $smile = SmileModel::create([
            'content' => $image,
        ]);

        return redirect()->back();
    }

    public function deleteSmile(Request $request)
    {
        $smile = SmileModel::find($request->get('id'));
        if(!$smile)
        {
            session()->flash('deleteSmileError','Такого смайлика нету');
            return redirect()->back();
        }
        $smile->delete();

        return redirect()->back();
    }

    public function deleteSmileApi($id)
    {
        $smile = SmileModel::find($id);
        $smile->delete();

        return $smile;
    }

    public function changeStatus(Request $request)
    {
        $user = User::find($request->get('user_id'));
        if(!$user){
            session()->flash('changeStatusError','Такого пользователя не существует');
            return redirect()->back();
        }
        $user->status = $request->get('user_status');
        $user->save();

        return redirect()->back();
    }

    public function deleteAdminChat(Request $request)
    {
        $user_sec_id = User::find($request->get('second_id'));
        $user_first_id = User::find($request->get('first_id'));
        $chat_id = $user_first_id->chat()->find($user_sec_id)->pivot->chat_id;
        $messages = \App\Models\Message::get()->where('chat_id','=', $chat_id);
        if($messages){
            foreach($messages as $message)
                $message->delete();
        }
        $user_first_id->chat()->detach($user_sec_id->id);
        $user_sec_id->chat()->detach($user_first_id->id);
        return redirect()->back();
    }
}
