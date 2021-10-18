<?php

namespace App\Http\Controllers;

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

    public function users()
    {
        $users = User::get();

        return view('admin.users.index', compact('users'));
    }

    public function chats()
    {
        $chats = ChatUserModel::get();

        return view('admin.chats.index', compact('chats'));
    }

    public function smiles()
    {
        $smiles = SmileModel::get();

        return view('admin.smiles.index', compact('smiles'));
    }

    public function messages()
    {
        $messages = \App\Models\Message::get();

        return view('admin.messages.index', compact('messages'));
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

    public function addSmile(Request $request)
    {
        $image = $request->file('image')->store('smile','public');
        $smile = SmileModel::create([
            'content' => $image,
        ]);

        return redirect()->back();
    }

    public function deleteSmile(Request $request)
    {
        $smile = SmileModel::find($request->get('id'));
        $smile->delete();

        return redirect()->back();
    }

    public function deleteSmileApi($id)
    {
        $smile = SmileModel::find($id);
        $smile->delete();

        return $smile;
    }
}
