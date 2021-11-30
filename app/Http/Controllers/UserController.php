<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;
use Mail;
use App\Mail\User\AfterRegister;
//ini kita kenal kan, email apa yang mau kita panggil

class UserController extends Controller
{
    public function login()
    {
    return view('auth.user.login');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {


       $callback = Socialite::driver('google')->stateless()->user();

    //    kita pasrsing data nya, data apa yang kita mau ambil
       $data = [
                'name' => $callback->getName(),
                'email' => $callback->getEmail(),
                'avatar' => $callback->getAvatar(),
                'email_verified_at' => date('Y-m-d H:i:s', time()),
       ];


        // $user = User::firstOrCreate(['email' => $data['email']], $data);


        //kita cek dulu data nya ada apa enggak
       $user = User::whereEmail($data['email'])->first();

        //jika tidak user
       if(!$user){
           //kita buat data baru
           $user = User::create($data);
           //ini fungsi nya kita memberi notifikasi ke email user
           Mail::to($user->email)->send(new AfterRegister($user));
       }

        Auth::login($user, true);

       return redirect(route('welcome'));
     }
}
