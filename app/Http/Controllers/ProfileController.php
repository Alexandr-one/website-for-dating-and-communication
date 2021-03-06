<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\ChangeRequest;
use App\Models\LikeUser;
use App\Models\User;
use App\Models\ZodiacModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $like = LikeUser::get()->where('user_compliment_id', '=' ,Auth::user()->id);
        $changeMess = session()->get('changeMess');

        return view('profile',compact('changeMess','like',));
    }
    public function change(ChangeRequest $request)
    {
        $user = Auth::user();
        if($request->file('image')) {
            $image = $request->file('image')->store('uploads', 'public');
        }else{
            $image = $user->image;
        }
        $user->fill([
            "image" => $image,
            "name" => $request->get('name'),
            "surname" => $request->get('surname'),
            "email" => $request->get('email'),
            "country" => $request->get("country"),
            "town" => $request->get("town"),
            "description" => $request->get("description"),
        ]);
        $user->save();
        session()->flash('changeMess','Вы удачно изменили пользователя');

        return redirect(route('profile'));
    }
}
