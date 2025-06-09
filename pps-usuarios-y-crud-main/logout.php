<?php
session_start();
session_destroy();
header('Location: Login.html'); // Redirige al login después de cerrar sesión
exit;
?>