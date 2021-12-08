<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CheckoutController as AdminCheckout;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



//sosialite route
Route::get('sign-in-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');

//Midtrans Route
//get kalau orang nya bayar pakai e-walet
Route::get('payment/success', [UserController::class, 'midtransCallback']);
//post kita gunakan untuk ketika orang nya bayar ke indomaret dan lain2
Route::post('payment/success', [UserController::class, 'midtransCallback']);


//ini dibuat untuk halaman yang bisa di akses ketika sudah login
Route::middleware(['auth'])->group(function () {

    //route untuk checkout
    Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success')->middleware('ensureUserRole:user'); //ensure berfungsi untuk memastikan dia sebagai user yang di atur di karnel
    Route::get('checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('checkout.create')->middleware('ensureUserRole:user');//ensure berfungsi untuk memastikan dia sebagai user yang di atur di karnel
    Route::post('checkout/{camp}', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('ensureUserRole:user');//ensure berfungsi untuk memastikan dia sebagai user yang di atur di karnel

    //dashboard
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    //user dashboard
    Route::prefix('user/dashboard')->namespace('User')->name('user.')->middleware('ensureUserRole:user')->group(function(){
        //itu userdashboard di ambil dari namespace, asli nya dashboardcontroller
        Route::get('/',[UserDashboard::class, 'index'])->name('dashboard');
    });

    //admin dashboard
    Route::prefix('admin/dashboard')->namespace('Admin')->name('admin.')->middleware('ensureUserRole:admin')->group(function(){
        //sama kayak user adminnya juga
        Route::get('/',[AdminDashboard::class, 'index'])->name('dashboard');

        //admin  checkout
        Route::post('checkout/{checkout}', [AdminCheckout::class, 'update'])->name('checkout.update');
    });


});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
