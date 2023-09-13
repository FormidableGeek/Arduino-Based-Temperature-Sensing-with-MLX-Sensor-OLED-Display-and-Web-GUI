<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Http\Request;
use App\Http\Controllers\diaryController;
use Illuminate\Queue\SerializesModels;

class contactMailer extends Mailable
{
    use Queueable, SerializesModels;
    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->contact=$request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('irealmagent@gmail.com')
        ->subject("Infrared thermometer reading")
        ->markdown('mail.html.message');
    }
}
