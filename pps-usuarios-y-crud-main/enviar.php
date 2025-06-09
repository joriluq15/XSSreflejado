<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Envio a BD</title>
</head>
<body>
    <center>
        <?php
        require 'conexion.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['correo'] ?? '');
            $password = $_POST['contra'] ?? '';
            $password2 = $_POST['contra2'] ?? '';

            // Validaciones básicas
            if (empty($username) || empty($email) || empty($password) || empty($password2)) {
                echo "<script>alert('Todos los campos son obligatorios'); window.history.back();</script>";
                exit;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('Correo electrónico no válido'); window.history.back();</script>";
                exit;
            }
            if ($password !== $password2) {
                echo "<script>alert('Las contraseñas no coinciden'); window.history.back();</script>";
                exit;
            }

            // Comprobar si el usuario ya existe
            $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                echo "<script>alert('El correo ya está registrado'); window.history.back();</script>";
                $stmt->close();
                exit;
            }
            $stmt->close();

            // Hashear la contraseña
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Insertar usuario
            $stmt = $conn->prepare('INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)');
            $stmt->bind_param('sss', $username, $email, $password_hash);
            if ($stmt->execute()) {
                echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.'); window.location.href='Login.html';</script>";
            } else {
                echo "<script>alert('Error al registrar usuario'); window.history.back();</script>";
            }
            $stmt->close();
            $conn->close();
        } else {
            header('Location: Registro.html');
            exit;
        }
        ?>
    </center>
</body>
</html>