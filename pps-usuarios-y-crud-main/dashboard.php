<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>
        alert('No estás logueado. Por favor, inicia sesión.');
        window.location.href = 'Login.html';
    </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <header>
        <h1>¡Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    </header>
    <div class="container">
        <h2>Selecciona una opción:</h2>
        <div class="options">
            <a href="mostrar_tabla.php">Mostrar Productos</a>
            <br>
            <a href="crear_producto.php">Crear Producto</a>
            <br>
            <a href="editar_producto.php">Editar Producto</a>
            <br>
            <a href="eliminar_producto.php">Eliminar Producto</a>
        </div>
        <div class="logout">
            <a href="logout.php">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>