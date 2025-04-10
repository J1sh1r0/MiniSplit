<h2>🧾 Nueva compra registrada</h2>

<p><strong>Folio:</strong> {{ $user->folio }}</p>
<p><strong>Nombre:</strong> {{ $user->name }} {{ $user->last_name }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
<p><strong>Teléfono:</strong> {{ $user->phone }}</p>
<p><strong>Dirección:</strong> {{ $user->address }} {{ $user->number }}{{ $user->is_apartment ? ', Int. ' . $user->no_interior : '' }}, Col. {{ $user->colonia }}, {{ $user->city }}, {{ $user->state }}, C.P. {{ $user->zip }}</p>

<p><strong>¿Es técnico?:</strong> {{ $user->is_technician ? 'Sí' : 'No' }}</p>
<p><strong>¿Requiere factura?:</strong> {{ $user->requires_invoice ? 'Sí' : 'No' }}</p>

@if ($user->requires_invoice)
    <h3>🧾 Datos de facturación</h3>
    <p><strong>RFC:</strong> {{ $user->invoice_rfc }}</p>
    <p><strong>Razón social:</strong> {{ $user->invoice_name }}</p>
    <p><strong>Régimen fiscal:</strong> {{ $user->invoice_regimen }}</p>
    <p><strong>Uso CFDI:</strong> {{ $user->invoice_cfdi_use }}</p>
    <p><strong>Dirección fiscal:</strong> {{ $user->invoice_street }} {{ $user->invoice_number }}{{ $user->invoice_interior ? ', Int. ' . $user->invoice_interior : '' }}, Col. {{ $user->invoice_colonia }}, {{ $user->invoice_city }}, {{ $user->invoice_state }}, {{ $user->invoice_country }}, C.P. {{ $user->invoice_zip }}</p>
@endif

<h3>🛒 Productos:</h3>
<ul>
    @foreach ($items as $key => $item)
        <li><strong>{{ $key }}</strong>: x{{ $item }}</li>
    @endforeach
</ul>

@if ($technician)
    <h3>🎥 Video de verificación (técnico)</h3>
    <p><a href="{{ asset('storage/' . $technician->verification_video) }}" target="_blank">Ver video</a></p>
@endif

<hr>
<p><small>Compra generada el {{ $user->created_at->format('d/m/Y H:i') }}</small></p>
