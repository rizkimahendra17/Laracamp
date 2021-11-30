<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterRegister extends Mailable
{
    use Queueable, SerializesModels;

    // kita buat variabel baru
    private $user;
    /**
     * Create a new message instance.
     *

     */
    //disini kita tangkap variabel user dari usercontroller
    public function __construct($user)
    {
        //ini kita buat superglobal nya
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     *
     */
    public function build()
    {
        return $this->subject('Registration on Laracamp')->markdown('emails.user.afterRegister',[
            'user' => $this->user
        ]);
    }
}
