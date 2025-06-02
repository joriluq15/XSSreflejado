# Proyecto Reserva de Mesas (Laravel)

Esta aplicación sirve para gestionar reservas de mesas en un restaurante. 
stá hecha con Laravel y utiliza MySQL como base de datos.

## Estructura y archivos principales

- routes/web.php: Define las rutas principales de la aplicación, como el listado, la creación y la eliminación de reservas.

- app/Models/Reservation.php: Modelo de la tabla `reservas` en la base de datos. Define los campos que se pueden rellenar y la conexión con la propia tabla.

- app/Http/Controllers/ReservationController.php: Controlador principal. Gestiona la lógica para mostrar el listado de reservas, el formulario de creación, guardar nuevas reservas y eliminar reservas.

- database/migrations/0001_01_01_000000_create_reservas_table.php: Migración que crea la tabla `reservas` con los campos necesarios (nombre, email, teléfono, número de personas, fecha de reserva).

- resources/views/reservations/index.blade.php: Vista Blade que muestra el listado de reservas y permite eliminarlas.

- resources/views/reservations/create.blade.php: Vista Blade con el formulario para crear una nueva reserva. Incluye validación y muestra errores si los datos no son válidos.

- tests/Feature/: Carpeta con pruebas automáticas (Pest) para verificar que:
  - Se puede acceder a las vistas principales.
  - Se puede crear y eliminar reservas.
  - No se guardan reservas con datos inválidos.

- .env: En este archivo se define la conexión con la BBDD indicando IP del host, nombre de la bbdd, usuario y contraseña

## Funcionamiento del proyecto

1. El usuario puede acceder al listado de reservas.
2. Puede crear una nueva reserva desde `/reservations/create`.
3. El formulario valida los datos (por ejemplo, el teléfono debe tener 9 dígitos).
4. Las reservas se guardan en la base de datos y se pueden eliminar desde el listado.
5. El proyecto incluye pruebas automáticas con PEST para asegurar su correcto funcionamiento.

TESTS:

Los test funcionan correctamente y comprueban que todas las funciones de la aplicación son correctas.