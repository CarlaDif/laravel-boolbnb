<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageFromWebsite extends Mailable
{
   use Queueable, SerializesModels;

   public $messaggio;

   public function __construct($new_message)
   {
     $this->messaggio = $new_message;
   }

   public function build()
   {
     return $this->from('test@boolbnb.it')->view('mails.new_message');
   }
}
