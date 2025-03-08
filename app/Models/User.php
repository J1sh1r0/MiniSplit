<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'last_name',       // <--- Agregado
        'email',
        'phone',
        'address',
        'number',          // <--- Agregado
        'city',
        'state',
        'zip',
        'colonia',         // <--- Agregado
        'no_interior',     // <--- Agregado
        'is_apartment',    // <--- Agregado (bool o tinyint)
        'requires_invoice', // <--- Agregado (bool o tinyint)
        'is_technician',
        // 'price',
        // 'paypal_order_id',
        'folio',
        'requires_invoice',
        'invoice_rfc',
        'invoice_name',
        'invoice_regimen',
        'invoice_cfdi_use',

    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
