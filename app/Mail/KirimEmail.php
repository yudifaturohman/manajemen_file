<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class KirimEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $bodyMessage;
    public $frommail;

    public function __construct($bodyMessage, $frommail)
    {
         $this->bodyMessage = $bodyMessage;
         $this->frommail = $frommail;
    }

    /**
    * Build the message.
    *
    * @return $this
    */
    public function build()
    {
        return $this->from($this->frommail)->view('file.kirim-email');
    }
}
