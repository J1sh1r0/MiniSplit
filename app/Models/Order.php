<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'folio',
        'name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'verification_video',
        'total',
        'payment_status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Generar folio único antes de guardar
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            $order->folio = 'ORD-' . strtoupper(Str::random(8)); // Ejemplo: ORD-A1B2C3D4
        });
    }
}
