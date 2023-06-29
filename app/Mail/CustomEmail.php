<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $confe;

    /**
     * Create a new message instance.
     *
     * @param  User  $user
     * @param  Conference  $confe
     * @return void
     */
    public function __construct($user, $confe)
    {
        $this->user = $user;
        $this->confe = $confe;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.custom')
                    ->with([
                        'user' => $this->user,
                        'confe' => $this->confe,
                    ]);
    }    

}
