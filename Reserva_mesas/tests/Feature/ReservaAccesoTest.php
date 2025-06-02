<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class, TestCase::class);

test('puede acceder a la vista de listado de reservas', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertSee('Reservas de Mesas');
});

test('puede acceder a la vista de creación de una reserva', function () {
    $response = $this->get('/reservations/create');
    $response->assertStatus(200);
    $response->assertSee('Nueva Reserva');
});
