<?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ID no especificado o inválido'); window.location.href='mostrar_tabla.php';</script>";
    exit;
}
$id = (int)$_GET['id'];
require 'conexion.php';

// Preparar la consulta para eliminar el producto
$stmt = $conn->prepare('DELETE FROM products WHERE id = ?');
if ($stmt) {
    $stmt->bind_param('i', $id);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Producto eliminado con éxito'); window.location.href='mostrar_tabla.php';</script>";
    } else {
        echo "<script>alert('No se encontró el producto con ese ID'); window.location.href='mostrar_tabla.php';</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('Error en la preparación de la consulta'); window.location.href='mostrar_tabla.php';</script>";
}
$conn->close();
?>