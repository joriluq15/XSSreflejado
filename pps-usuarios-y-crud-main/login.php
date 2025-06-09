<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $email = $_POST["correo"];
    $password = $_POST["contra"];

    // Conexión a la base de datos
    $servername = "localhost";
    $dbusername = "admin";
    $dbpassword = "Ciber";
    $dbname = "bdgit";

    // Crear conexión
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Buscar el usuario por correo electrónico
    $sql = "SELECT username, password_hash FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener los datos del usuario
        $user = $result->fetch_assoc();
        $hashed_password = $user["password_hash"];

        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user["username"]; // Guarda el nombre de usuario en sesión
            header('Location: dashboard.php');
            exit;
        } else {
            echo ("<script>window.alert('Usuario o contraseña incorrectos');window.history.back();</script>");
        }
    } else {
        echo "Usuario o contraseña incorrectos";
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
