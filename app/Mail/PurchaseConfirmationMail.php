<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $items;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, array $items)
    {
        $this->user = $user;
        $this->items = $items;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Gracias por tu compra')
                    ->view('emails.purchase-confirmation');
    }
}
