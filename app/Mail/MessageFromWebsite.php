<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Message;

class MessageFromWebsite extends Mailable
{
   use Queueable, SerializesModels;

   public $messaggio;

   public function __construct(Message $new_message)
   {
     $this->messaggio = $new_message;
   }

   public function build()
   {
     return $this->from('info@boolbnb.it')->view('mails.new_message');
   }
}
