<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Reservation;

uses(RefreshDatabase::class, TestCase::class);

test('puede eliminar una reserva y desaparece de la base de datos', function () {
    $reserva = Reservation::create([
        'nombre_cliente' => 'Eliminar Test',
        'email_cliente' => 'eliminar@example.com',
        'telefono' => '987654321',
        'numero_personas' => 2,
        'fecha_reserva' => now()->addDays(2)->format('Y-m-d H:i:s'),
    ]);
    $response = $this->delete('/reservations/' . $reserva->id);
    $response->assertRedirect('/');
    $this->assertDatabaseMissing('reservas', [
        'id' => $reserva->id,
    ]);
});
