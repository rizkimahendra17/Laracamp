<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use Auth;

//itu kita ambil data dari model nya dari database
//untuk auth kita mengambil data orang yang login

class HomeController extends Controller
{
    public function dashboard(){

        //ini maksud nya mengambil data dari checkout dan camp dimana user_id yang lagi login
        $checkouts = Checkout::with('Camp')->where('user_id', Auth::id())->get();


        return view ('user.dashboard',[
            'checkouts' =>$checkouts
        ]);
    }
}
