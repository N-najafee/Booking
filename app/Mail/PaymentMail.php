<?php

namespace App\Mail;


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $booking;
    public $totalAmount;
    public $authority;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $booking, $totalAmount, $authority)
    {
        $this->user = $user;
        $this->booking = $booking;
        $this->totalAmount = $totalAmount;
        $this->authority = $authority;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.payment')
            ->subject('Mail order detail')
            ->to($this->user->email);
    }
}

