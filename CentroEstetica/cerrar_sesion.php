<?php
session_start();

if (isset($_SESSION['usuario_autenticado']) && $_SESSION['usuario_autenticado'] === true) {
    // Cierra la sesión
    session_unset();
    session_destroy();
}

header("Location: login.php"); // Redirige al usuario a la página de inicio de sesión
exit;
