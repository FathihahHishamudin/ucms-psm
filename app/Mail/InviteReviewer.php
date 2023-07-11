<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteReviewer extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $confe;
    public $paper;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Conference $confe
     * @param Paper $paper
     * @return void
     */
    public function __construct($user, $confe, $paper)
    {
        $this->user = $user;
        $this->confe = $confe;
        $this->paper = $paper;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reviewerinvitation')
                    ->subject('Invitation to Review')
                    ->with([
                        'user' => $this->user,
                        'confe' => $this->confe,
                        'paper' => $this->paper,
                    ]);
    } 
}
