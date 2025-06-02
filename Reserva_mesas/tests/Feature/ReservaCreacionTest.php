<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class, TestCase::class);

test('puede crear una reserva válida y se guarda en la base de datos', function () {
    $data = [
        'nombre_cliente' => 'Juan Pérez',
        'email_cliente' => 'juan@example.com',
        'telefono' => '123456789',
        'numero_personas' => 4,
        'fecha_reserva' => now()->addDay()->format('Y-m-d H:i:s'),
    ];
    $response = $this->post('/reservations', $data);
    $response->assertRedirect('/');
    $this->assertDatabaseHas('reservas', [
        'nombre_cliente' => 'Juan Pérez',
        'email_cliente' => 'juan@example.com',
        'telefono' => '123456789',
        'numero_personas' => 4,
    ]);
});
