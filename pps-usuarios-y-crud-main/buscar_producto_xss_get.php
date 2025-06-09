<?php
require 'conexion.php';

// Vulnerabilidad XSS reflejado por GET
$search = $_GET['q'] ?? '';
$results = [];

if ($search !== '') {
    $search_sql = $conn->real_escape_string($search);
    $sql = "SELECT * FROM products WHERE name LIKE '%$search_sql%'";
    $result = $conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Búsqueda de Productos (Vulnerable XSS GET)</title>
</head>
<body>
    <h1>Buscar Producto (Vulnerable a XSS por GET)</h1>
    <form method="get">
        <input type="text" name="q" placeholder="Buscar por nombre" value="<?php echo $search; ?>">
        <button type="submit">Buscar</button>
    </form>
    <?php if ($search !== ''): ?>
        <h2>Resultados para: <?php echo $search; ?></h2>
        <ul>
        <?php foreach ($results as $row): ?>
            <li><?php echo $row['name']; ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>