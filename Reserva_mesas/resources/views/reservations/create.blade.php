<!DOCTYPE html>
<html>
<head>
    <title>Nueva Reserva</title>
</head>
<body>
    <h1>Nueva Reserva</h1>
    <form method="POST" action="{{ route('reservations.store') }}">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre_cliente" value="{{ old('nombre_cliente') }}" required><br>
        <label>Email:</label>
        <input type="email" name="email_cliente" value="{{ old('email_cliente') }}"><br>
        <label>Teléfono:</label>
        <input type="text" name="telefono" value="{{ old('telefono') }}"><br>
        <label>Número de personas:</label>
        <input type="number" name="numero_personas" value="{{ old('numero_personas') }}" required min="1"><br>
        <label>Fecha y hora:</label>
        <input type="datetime-local" name="fecha_reserva" value="{{ old('fecha_reserva') }}" required><br>
        <button type="submit">Reservar</button>
    </form>
    <a href="{{ route('reservations.index') }}">Volver</a>
    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
