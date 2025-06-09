<?php
require 'conexion.php';

// Vulnerabilidad XSS reflejado por POST
$search = '';
$results = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = $_POST['q'] ?? '';
    // Intenta la consulta, pero si falla, ignora el error para que el XSS se refleje igual
    $sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
    try {
        $result = $conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
        }
    } catch (Exception $e) {
        // Ignorar el error SQL, solo mostrar el valor reflejado
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Búsqueda de Productos (Vulnerable XSS POST)</title>
</head>
<body>
    <h1>Buscar Producto (Vulnerable a XSS por POST)</h1>
    <form method="post">
        <input type="text" name="q" placeholder="Buscar por nombre">
        <button type="submit">Buscar</button>
    </form>
    <?php if ($search !== ''): ?>
        <h2>Resultados para: <?php echo $search; // No escapar, vulnerable ?></h2>
        <ul>
        <?php foreach ($results as $row): ?>
            <li><?php echo $row['name']; ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
