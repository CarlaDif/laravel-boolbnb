<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Message;

class MessageConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public $messaggio;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $new_message)
    {
      $this->messaggio = $new_message;
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
