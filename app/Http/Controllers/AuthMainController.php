<?php

namespace App\Http\Controllers;

use App\Classes\UserStatusEnum;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Models\LikeUser;
use App\Models\User;
use App\Models\ZodiacModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Psy\Util\Str;
use SebastianBergmann\CodeCoverage\Report\Text;

class AuthMainController extends Controller
{

    public function verification()
    {
        $errors = session()->get('verificError');
        return view('verify',compact('errors'));
    }

    public function main()
    {
        $users = User::get();
        $loginErrors = session()->get('loginErrors');

        return view('first',compact('users','loginErrors'));
    }

    public function sendMessToEmail()
    {
        $user = Auth::user();
        $user->verification_token = \Illuminate\Support\Str::random(6);
        $user->save();
        $title = 'Подтверждение аккаунта';
        $name = 'Сайт знакомств Dating';
        $email = $user->email;
        Mail::raw($user->verification_token,function($message) use ($email,$name,$title){
            $message->to($email , 'To web dev blog')->subject($title);
            $message->from('2004sasharyzhakov@gmail.com',$name);
        });

        return redirect()->back();
    }
    public function registration()
    {
        $user_id = 0;
        $like = LikeUser::get()->where('user_compliment_id', '=' ,$user_id and Auth::user()->id,'user_liked_id');
        $loginError = session()->get('loginErrors');
        return view('welcome',compact('loginError','like') );
    }

    public function index(Request $request)
    {

        $user = User::get();
        foreach($user as $userNum) {
            $userNum->age = Carbon::parse($userNum->date_of_birth)->diffInYears();
            $userNum->save();
        }
        $getCountry = "";
        $getTown = "";
        $getSex = '';
        $selPar = '';
        $getPar = '';
        $getAgeMinPar = "";
        $getAgeMaxPar = "";
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
            $getPar = $request->get('nameFilled');
        }
        if($request->get('surnameFilled')) {
            $users->where('surname', 'LIKE', "%" . $request->get('surnameFilled') . "%");
            $getPar = $request->get('surnameFilled');
        }
        if($request->get('min_age')){
            $users->where('age','>=', $request->get('min_age'));
            $getAgeMinPar = $request->get('min_age');
        }
        if($request->get('max_age')) {
            $users->where('age', '<=', $request->get('max_age'));
            $getAgeMaxPar = $request->get('max_age');
        }
        $maleCount = $users->get()->where('sex','=','Мужской')->count();
        $femaleCount = $users->get()->where('sex','=','Женский')->count();
        session()->flash('message', "Найдено {$users->count()} пользователей, {$maleCount} мужчин и {$femaleCount} женщин");
        $message = session()->get('message');
        $users = $users->paginate(12)
            ->withPath('?' . $request->getQueryString());

        return view('main', compact('users', 'getTown','getCountry','message','getSex', 'selPar', 'getPar','getAgeMinPar','getAgeMaxPar'));
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email','password'))) {
            session()->flash('loginErrors','Неверно введены данные');

            return redirect()->back();
        }
        else if (Auth::attempt($request->only('email','password'))){
            $user = Auth::user();
        }

        return redirect()->route('index');
    }

    public function register(AuthRequest $request)
    {

        $age = Carbon::parse($request->get('date'))->diffInYears();
        $image = 'uploads/unknown.jpg';
        if($request->file('image')){
            $image = $request->file('image')->store('uploads','public');
        }
        $token = \Illuminate\Support\Str::random(6);
        $sex = $request->get('female');
        $user = User::create([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'image' => $image,
            'age' => $age,
            'country' => $request->get('country'),
            'town' => $request->get('town'),
            'date_of_birth' => $request->get('date_of_birth'),
            'sex' => $request->filled("male") ? "Мужской" : ($sex ? "Женский" : "Специфичный"),
            'verification_token' => $token,
        ]);
        $date = Carbon::parse($user->date_of_birth);
        $znaks= ZodiacModel::get();
        $znaksIds = array();
        foreach($znaks as $znak)
            array_push($znaksIds, $znak->id);
        foreach ($znaksIds as $znaksId){
            if($date->isoFormat('M') == $znaksId){
                $zodiac = ZodiacModel::find($znaksId);
                $user->zodiac()->attach($zodiac->id);
            }
        }
        $email = $request->get('email');
        $title = 'Подтверждение аккаунта';
        $name = 'Сайт знакомств Dating';
        Auth::login($user);
        $this->sendMessToEmail();
        session()->flash('message',"Вы зарегистрировались, введите дополнительные данные");

        return redirect()->route('verify');
    }

    public function sendToken(Request $request)
    {
        if(Auth::user()->verification_token == $request->get('token'))
        {
            Auth::user()->status = UserStatusEnum::ACTIVE;
            Auth::user()->save();
        }else{
            session()->flash('verificError','Неправильный код');
            return redirect()->back();
        }

        return redirect(route('index'));
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('first'));
    }

    public function image($id)
    {
        $userImg = User::find($id);
        return $userImg;
    }
    public function send(Request $request)
    {
        $this->validate($request,[
            'sendEmail' => 'required|email',
            'sendText' => 'required|min:5',
            'sendName' => 'required|min:5',
            'sendTitle' => 'required|min:5',
        ]);
        $mail = $request->get('sendEmail');
        $posts = $request->get('sendText');
        $name = $request->get('sendName');
        $title = $request->get('sendTitle');
        Mail::raw($posts,function($message) use ($mail,$name,$title){
            $message->to($mail , 'To web dev blog')->subject($title);
            $message->from('2004sasharyzhakov@gmail.com',$name);
        });
        session()->flash('message','Вы отправили сообщение на почту '.$mail);
        return redirect()->back();
    }

}
