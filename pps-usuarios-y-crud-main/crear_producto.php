<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = $_POST['price'] ?? '';
    $stock = $_POST['stock'] ?? '';

    // Validaciones básicas
    if (empty($name) || empty($description) || $price === '' || $stock === '') {
        echo "<script>alert('Todos los campos son obligatorios'); window.history.back();</script>";
        exit;
    }
    if (!is_numeric($price) || $price < 0) {
        echo "<script>alert('El precio debe ser un número positivo'); window.history.back();</script>";
        exit;
    }
    if (!is_numeric($stock) || $stock < 0) {
        echo "<script>alert('El stock debe ser un número positivo'); window.history.back();</script>";
        exit;
    }

    // Insertar producto con sentencia preparada
    $stmt = $conn->prepare('INSERT INTO products (name, description, price, stock) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssdi', $name, $description, $price, $stock);
    if ($stmt->execute()) {
        echo "<script>alert('Producto creado con éxito.'); window.location.href='mostrar_tabla.php';</script>";
    } else {
        echo "<script>alert('Error al crear el producto'); window.history.back();</script>";
    }
    $stmt->close();
    $conn->close();
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Producto</title>
</head>
<body>
    <h1>Crear Producto</h1>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="name" required><br>
        <label>Descripción:</label><br>
        <textarea name="description" required></textarea><br>
        <label>Precio:</label><br>
        <input type="number" name="price" step="0.01" min="0" required><br>
        <label>Stock:</label><br>
        <input type="number" name="stock" min="0" required><br>
        <button type="submit">Crear</button>
    </form>
    <a href="dashboard.php">Volver al Dashboard</a>
</body>
</html>
