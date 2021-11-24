<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Checkout;
use Auth;

class Camp extends Model
{
    use HasFactory, SoftDeletes;

    //ini kita kenal kan yang hanya bisa di edit
   protected $fillable = ['title', 'price'];

   public function getIsRegisteredAttribute()
   {
       //ini kita check dulu kalau gak ada yang login maka return false
        if (!Auth::check()) {
            return false;
        }
        //ini kalau ada yang login
        return Checkout::where('camp_id', $this->id)->where('user_id', Auth::id())->exists();

   }
}
