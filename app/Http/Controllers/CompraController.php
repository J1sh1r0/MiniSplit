<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Technician;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseConfirmationMail;
use App\Mail\PurchaseInvoiceMail; // <--- Importar tu nuevo Mailable de factura



class CompraController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'name'             => 'required|string|max:255',
            'last_name'        => 'nullable|string|max:255', // <--- Nuevo
            'email'            => 'required|email|unique:users,email|max:255',
            'phone'            => 'required|string|max:20',
            'address'          => 'required|string|max:255',
            'number'           => 'nullable|string|max:255',  // <--- Nuevo
            'city'             => 'required|string|max:255',
            'state'            => 'required|string|max:255',
            'zip'              => 'required|string|max:10',
            'colonia'          => 'nullable|string|max:255',  // <--- Nuevo
            'no_interior'      => 'nullable|string|max:255',  // <--- Nuevo
            'is_apartment'     => 'required|boolean',         // <--- Nuevo
            'requires_invoice' => 'required|boolean',         // <--- Nuevo
            'is_technician'    => 'required|boolean',
            'verification_video' => 'nullable|file|mimes:mp4,avi,mov|max:10240',
            'items'            => 'required', // <--- para que sea obligatorio recibir el carrito
            'requires_invoice' => 'required|boolean',
            'invoice_rfc'      => 'required_if:requires_invoice,1|max:14', // Ajusta a 12/13
            'invoice_name'     => 'required_if:requires_invoice,1|max:255',
            'invoice_regimen'  => 'required_if:requires_invoice,1|max:255',
            'invoice_cfdi_use' => 'required_if:requires_invoice,1|max:255',
            // Dirección de facturación (solo si requiere_invoice = true)
            'invoice_street'    => 'required_if:requires_invoice,1|max:255',
            'invoice_number'    => 'required_if:requires_invoice,1|max:255',
            'invoice_interior'  => 'nullable|string|max:255',
            'invoice_colonia'   => 'required_if:requires_invoice,1|max:255',
            'invoice_city'      => 'required_if:requires_invoice,1|max:255',
            'invoice_state'     => 'required_if:requires_invoice,1|max:255',
            'invoice_zip'       => 'required_if:requires_invoice,1|max:10',
            'invoice_country'   => 'required_if:requires_invoice,1|max:255',

        ]);

        $items = json_decode($request->items, true);
        $folio = strtoupper(Str::random(10));


        // Crear usuario con los campos nuevos
        $user = User::create([
            'name'             => $request->name,
            'last_name'        => $request->last_name,      // <--- Nuevo
            'email'            => $request->email,
            'phone'            => $request->phone,
            'address'          => $request->address,
            'number'           => $request->number,
            'city'             => $request->city,
            'state'            => $request->state,
            'zip'              => $request->zip,
            'colonia'          => $request->colonia,        // <--- Nuevo
            'no_interior'      => $request->no_interior,    // <--- Nuevo
            'is_apartment'     => $request->is_apartment,   // <--- Nuevo
            'requires_invoice' => $request->requires_invoice, // <--- Nuevo
            'is_technician'    => $request->is_technician,
            'folio'            => $folio,
            'requires_invoice' => $request->requires_invoice,
            'invoice_rfc'      => $request->invoice_rfc,
            'invoice_name'     => $request->invoice_name,
            'invoice_regimen'  => $request->invoice_regimen,
            'invoice_cfdi_use' => $request->invoice_cfdi_use,
            // Dirección de facturación
            'invoice_street'   => $request->invoice_street,
            'invoice_number'   => $request->invoice_number,
            'invoice_interior' => $request->invoice_interior,
            'invoice_colonia'  => $request->invoice_colonia,
            'invoice_city'     => $request->invoice_city,
            'invoice_state'    => $request->invoice_state,
            'invoice_zip'      => $request->invoice_zip,
            'invoice_country'  => $request->invoice_country,
        ]);

        // Si es técnico, guardar el video de verificación
        if ($request->is_technician) {
            $videoPath = null;
            if ($request->hasFile('verification_video')) {
                $videoPath = $request->file('verification_video')->store('videos_tecnicos', 'public');
            }

            Technician::create([
                'user_id'            => $user->id,
                'verification_video' => $videoPath,
                'verified'           => false, // Se verificará manualmente después
            ]);
        }

        // 3. Si el usuario requiere factura
        if ($user->requires_invoice) {
            // Enviamos un correo de factura
            Mail::to($user->email)->send(new PurchaseInvoiceMail($user, $items));
        } else {
            // Enviamos un correo de confirmación normal
            Mail::to($user->email)->send(new PurchaseConfirmationMail($user, $items));
        }
        return response()->json([
            'success' => true,
            'message' => 'Compra registrada con éxito.',
            'user_id' => $user->id,
        ]);
    }
}
