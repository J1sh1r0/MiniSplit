<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF; // <--- Asegúrate de usar el facade "PDF" (barryvdh/laravel-dompdf)

class PurchaseInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $items;

    public function __construct(User $user, array $items)
    {
        $this->user = $user;
        $this->items = $items;
    }

    public function build()
    {
        // 1) Generamos el PDF a partir de la vista "pdf.invoice"
        //    Le pasamos los datos que necesite la vista: $user y $items
        $pdf = PDF::loadView('pdf.invoice', [
            'user' => $this->user,
            'items' => $this->items,
        ]);

        // 2) Convertimos ese PDF a un string con ->output()
        //    Y lo adjuntamos con ->attachData(...)
        return $this->subject('Tu factura y compra en Minisplit')
                    ->view('emails.purchase-invoice') // Tu vista normal de email
                    ->attachData(
                        $pdf->output(),
                        'factura-'.$this->user->folio.'.pdf', // Nombre del archivo PDF
                        [
                            'mime' => 'application/pdf',
                        ]
                    );
    }
}
