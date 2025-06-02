<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'numero_personas' => 'required|integer|min:1',
            'fecha_reserva' => 'required|date',
            'email_cliente' => 'nullable|email',
            'telefono' => ['nullable', 'regex:/^\d{9}$/'],
        ], [
            'telefono.regex' => 'El teléfono debe tener exactamente 9 dígitos.',
        ]);

        Reservation::create($validated);
        return redirect()->route('reservations.index')->with('success', 'Reserva creada correctamente.');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reserva eliminada correctamente.');
    }
}
