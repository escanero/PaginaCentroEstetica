<?php

include("pruebaGratis.php");

$success_message = '';
$error_message = '';

$servername = "localhost";
$username = "root";
$password = "marsupilami00";
$dbname = "ideal";

// Comprueba si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    // Valida los datos (puedes agregar más validaciones según tus necesidades)
    if (!empty($nombre) && !empty($apellido) &&  !empty($email) && !empty($pass)) {
        // Crea una conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Inserta los datos en la tabla
        $sql = "INSERT INTO usuarios (nombre,  apellido, email, pass) VALUES ('$nombre','$apellido', '$email', '$pass')";

        
        if ($conn->query($sql) === TRUE) {
            $success_message = "Datos ingresados correctamente.";
        } else {
            $error_message = "Error al ingresar los datos: " . $conn->error;
        }

        // Cierra la conexión a la base de datos
        $conn->close();
    } else {
        echo "Nombre y correo electrónico son campos requeridos.";
    }
}
?>
