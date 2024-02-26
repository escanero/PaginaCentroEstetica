<?php
session_start();

// Comprobar si se ha pasado un índice
if (isset($_GET['indice'])) {
    $indice = $_GET['indice'];

    // Eliminar el producto del carrito
    if (isset($_SESSION['carrito'][$indice])) {
        unset($_SESSION['carrito'][$indice]);
        echo "Producto eliminado correctamente.";
    } else {
        echo "Índice no válido.";
    }
} else {
    echo "No se proporcionó índice.";
}
?>
