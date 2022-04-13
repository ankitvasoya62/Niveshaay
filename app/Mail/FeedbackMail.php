<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;
    public $feedback;
    public $first_name;
    public $last_name;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($feedback,$first_name = '',$last_name='',$email = '')
    {
        $this->feedback = $feedback;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('frontend.feedback');
    }
}
