<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use Auth;

class DashboardController extends Controller
{
    public function index(){
         //ini maksud nya mengambil data dari checkout dan camp dimana user_id yang lagi login
         $checkouts = Checkout::with('Camp')->where('user_id', Auth::id())->get();


         return view ('user.dashboard',[
             'checkouts' =>$checkouts
         ]);
    }
}
