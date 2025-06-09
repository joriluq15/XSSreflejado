<?php
$servername = "localhost";    // Nombre del servidor
$dbusername = "admin";        // Usuario de la base de datos
$dbpassword = "Ciber";        // Contraseña de la base de datos
$dbname = "bdgit";            // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Opcional: Puedes activar esta línea si deseas comprobar que la conexión funciona correctamente
// echo "Conexión exitosa";
?>