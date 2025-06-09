<?php
require 'conexion.php';

// Validar ID recibido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ID de producto no válido'); window.location.href='mostrar_tabla.php';</script>";
    exit;
}
$id = (int)$_GET['id'];

// Obtener datos actuales del producto
$stmt = $conn->prepare('SELECT * FROM products WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    echo "<script>alert('Producto no encontrado'); window.location.href='mostrar_tabla.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = $_POST['price'] ?? '';
    $stock = $_POST['stock'] ?? '';

    // Validaciones
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

    // Actualizar producto
    $stmt = $conn->prepare('UPDATE products SET name=?, description=?, price=?, stock=? WHERE id=?');
    $stmt->bind_param('ssdii', $name, $description, $price, $stock, $id);
    if ($stmt->execute()) {
        echo "<script>alert('Producto actualizado con éxito.'); window.location.href='mostrar_tabla.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el producto'); window.history.back();</script>";
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
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br>
        <label>Descripción:</label><br>
        <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea><br>
        <label>Precio:</label><br>
        <input type="number" name="price" step="0.01" min="0" value="<?php echo htmlspecialchars($product['price']); ?>" required><br>
        <label>Stock:</label><br>
        <input type="number" name="stock" min="0" value="<?php echo htmlspecialchars($product['stock']); ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="dashboard.php">Volver al Dashboard</a>
</body>
</html>