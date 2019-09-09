<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public $message;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($new_message)
    {
      $this->message = $new_message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.confirm');
    }
}
