<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

//itu kita ambil data dari model nya dari database
//untuk auth kita mengambil data orang yang login

class HomeController extends Controller
{
    public function dashboard()
    {
        switch (Auth::user()->is_admin) {
            case true:
                return redirect(route('admin.dashboard'));
                break;

            default:
                return redirect(route('user.dashboard'));
                break;
        }

    }
}
