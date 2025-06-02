<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'nombre_cliente',
        'email_cliente',
        'telefono',
        'numero_personas',
        'fecha_reserva',
    ];
}
