<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class passwordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($random_password,$name='')
    {
        //
        $this->password = $random_password;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('frontend.passwordMail');
    }
}
