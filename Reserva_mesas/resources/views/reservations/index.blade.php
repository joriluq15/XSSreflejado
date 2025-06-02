<!DOCTYPE html>
<html>
<head>
    <title>Reservas</title>
</head>
<body>
    <h1>Reservas de Mesas</h1>
    <a href="{{ route('reservations.create') }}">Nueva Reserva</a>
    <ul>
        @foreach($reservations as $reservation)
            <li>
                <strong>Nombre:</strong> {{ $reservation->nombre_cliente }}<br>
                <strong>Email:</strong> {{ $reservation->email_cliente ?? '-' }}<br>
                <strong>Teléfono:</strong> {{ $reservation->telefono ?? '-' }}<br>
                <strong>Número de personas:</strong> {{ $reservation->numero_personas }}<br>
                <strong>Fecha y hora:</strong> {{ $reservation->fecha_reserva }}<br>
                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar esta reserva?')">Eliminar</button>
                </form>
            </li>
            <hr>
        @endforeach
    </ul>
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
    @if($errors->any())
        <div style="color:red">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
