<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyTestMail extends Mailable
{
    use Queueable, SerializesModels;

    private $ripFName;
    private $ripLName;

    public function __construct($ripFName,$ripLName){
        $this->ripFName = $ripFName;
        $this->ripLName = $ripLName;
    }

    public function build()
    {
        return $this->from('nathankussa@gmail.com')
                    ->subject('Ticket has been created')
                    ->view('mail.ticketCreatedMail', ['ripFName' => $this->ripFName,
                                                       'ripLName' => $this->ripLName  ]);
    }
}
