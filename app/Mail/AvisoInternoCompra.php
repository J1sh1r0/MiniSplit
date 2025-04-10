<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AvisoInternoCompra extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $items;
    public $technician;

    public function __construct($user, $items, $technician = null)
    {
        $this->user = $user;
        $this->items = $items;
        $this->technician = $technician;
    }

    public function build()
    {
        return $this->subject('🧾 Nueva compra registrada - ' . $this->user->folio)
            ->view('emails.aviso-interno-compra');
    }
}
