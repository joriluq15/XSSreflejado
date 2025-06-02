<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class, TestCase::class);

test('no guarda una reserva con datos inválidos y muestra errores de validación', function () {
    $data = [
        'nombre_cliente' => '', // nombre vacío
        'telefono' => '123', // teléfono inválido
        'numero_personas' => 0, // número inválido
        'fecha_reserva' => '', // fecha vacía
    ];
    $response = $this->post('/reservations', $data);
    $response->assertSessionHasErrors(['nombre_cliente', 'numero_personas', 'fecha_reserva', 'telefono']);
    $this->assertDatabaseCount('reservas', 0);
});
