<?php
session_start();

include("pruebaGratis.php");

// Inicializa las variables de mensaje de éxito y error
$success_message = '';
$error_message = '';

// Establece la conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = "marsupilami00";
$dbname = "ideal";

// Comprueba si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];

    // Realiza la validación de los datos aquí
    if (empty($nombre) || empty($email) || empty($telefono)) {
        $error_message = "Por favor, completa todos los campos.";
    } else {
        // Crea una conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Comprueba si el email ya existe en la base de datos
        $sql = "SELECT email FROM prueba WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // El email ya existe
            $error_message = "El email ya está registrado para la prueba gratis.";
        } else {
            // Inserta los datos en la tabla
            $sql = "INSERT INTO prueba (nombre, email, telefono) VALUES ('$nombre', '$email', '$telefono')";

            if ($conn->query($sql) === TRUE) {
                $success_message = "Datos ingresados correctamente.";
            } else {
                $error_message = "Error al ingresar los datos: " . $conn->error;
            }
        }

        // Cierra la conexión a la base de datos
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centros Ideal</title>
    <link rel="icon" href="CSS/logo_ideal_A.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans&display=swap" rel="stylesheet">
    

</head>

<body>
    <header class="header2">
        <div class="head">
            <?php
            // Verifica si el usuario está autenticado
            if (isset($_SESSION['usuario_autenticado']) && $_SESSION['usuario_autenticado'] === true) {
                echo '<div class="mensaje">Bienvenido, ' . $_SESSION['email'] . '<br> <a href="cerrar_sesion.php">Cerrar sesion</a></div>';
            }
            ?>
            <div class="botones">
                <a href="carrito.php"><span class="material-symbols-outlined" title="Carrito">
                        shopping_cart
                    </span></a>
                <a href="login.php"><span class="material-symbols-outlined" title="Log In">
                        login
                    </span></a>
            </div>
            <div>
                <a href="Index.php"><img class="fotoH" src="CSS/Icono_ideal-removebg-preview.png" title="Centros Ideal"></a>
            </div>
        </div>
        <div id="menu">
            <ul class="menuV">
                <li><a href="Index.php">Inicio</a></li>


                <li><a href="depilacion.php">Depilación</a>
                    <ul class="menu-vertical">
                        <li><a href="depilacion.php">Depilación láser para ellas</a></li>
                        <li><a href="depilacion.php">Depilación láser para ellos</a></li>
                        <li><a href="depilacion.php">Nuestra tecnología</a></li>
                        <li><a href="depilacion.php">Precios</a></li>
                    </ul>
                </li>



                <li><a href="estetica.php">Estética</a>
                    <ul class="menu-vertical">
                        <li><a href="esteticaFacial.php">Facial</a>
                            <ul class="mV">
                                <li><a href="esteticaFacial.php">Dermopen Deluxe</a></li>
                                <li><a href="esteticaFacial.php">Hidro Limpieza</a></li>
                                <li><a href="esteticaFacial.php">Antiedad Milena</a></li>
                                <li><a href="esteticaFacial.php">Iluminadore Milena</a></li>
                                <li><a href="esteticaFacial.php">Cyclone Luxury</a></li>
                                <li><a href="esteticaFacial.php">Cosmetología facial</a></li>
                            </ul>
                        </li>
                        <li><a href="esteticaCorporal.php">Corporal</a>
                            <ul>
                                <li><a href="esteticaCorporal.php">Liporemodelador integral</a></li>
                                <li><a href="esteticaCorporal.php">Reductor Local</a></li>
                                <li><a href="esteticaCorporal.php">Anticelulítico Cellulite Pro</a></li>
                                <li><a href="esteticaCorporal.php">Reafirmante Firm Up</a></li>
                                <li><a href="esteticaCorporal.php">Remodelador Cyclone</a></li>
                                <li><a href="esteticaCorporal.php">Maderoterapia</a></li>

                            </ul>
                        </li>
                    </ul>
                </li>

                <li><a href="medicina.php">Medicina Estética</a>
                    <ul class="menu-vertical">

                        <li><a href="medicinaFacil.php">Facial</a>
                            <ul>

                                <li><a href="medicinaFacil.php">Perfilado de labios</a></li>
                                <li><a href="medicinaFacil.php">Aumento de labios</a></li>
                                <li><a href="medicinaFacil.php">Russian Lips</a></li>
                                <li><a href="medicinaFacil.php">Tratamiento de ojeras</a></li>
                                <li><a href="medicinaFacil.php">Skinbooster</a></li>
                                <li><a href="medicinaFacil.php">Marcación mandibular</a></li>
                                <li><a href="medicinaFacil.php">Rinomodelación</a></li>
                                <li><a href="medicinaFacil.php">Rellenos faciales</a></li>
                                <li><a href="medicinaFacil.php">Rejuvenecimiento del tercio superior</a></li>
                            </ul>
                        </li>
                        <li><a href="medicinaCorporal.php">Corporal</a>
                            <ul>
                                <li><a href="medicinaCorporal.php">Carboxiterapia corporal</a></li>
                                <li><a href="medicinaCorporal.php">Mesofosis</a></li>

                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="centro.php">Centro</a></li>
                <a href="ofertas.php" class="botonO">OFERTAS</a>






            </ul>
        </div>

    </header>
    <section>
        <div class="container">
            <form action="" class="slide-in-bottom" method="post" onsubmit="return confirmSubmit()">
                <h4 class="titulo">Solicita una prueba gratis</h4>
                <?php if (!empty($error_message)) : ?>
                    <div class="error"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <?php if (!empty($success_message)) : ?>
                    <div class="success"><?php echo $success_message; ?></div>
                <?php endif; ?>
                <div class="padre">
                    <div class="nombre">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" placeholder="Nombre*" required>
                    </div>
                    <div class="correo">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" placeholder="Email*" required>
                    </div>
                    <div class="teléfono">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" maxlength="10" placeholder="Teléfono*" required>
                    </div>
                    <div class="condiciones">
                        <input class="checkbox" type="checkbox" name="condiciones" required>&nbsp;&nbsp;*Acepta los términos y
                        condiciones.
                        <CENTER><a href="privacidad.html">Saber más</a></CENTER>
                    </div>

                    <div class="botonE">
                        <input class="botonE" type="submit" value="Enviar">
                    </div>


                </div>
            </form>
        </div>
        <script>
            function validarFormulario() {
                var checkbox = document.querySelector('input[name="condiciones"]');

                if (!checkbox.checked) {
                    alert("Por favor, acepta los términos y condiciones antes de enviar el formulario.");
                    return false; // Evita que el formulario se envíe
                }

                return true; // Permite que el formulario se envíe si el checkbox está marcado
            }
        </script>

    </section>


    <div class="container-portada">
        <div class="capa-gradient"></div>
        <div class="container- details">
            <div class="details"></div>
            <div class="descuentos">
                <div class="descuentos2">
                    <div>
                        <img src="CSS/descuento_2-removebg-preview.png">
                        <div>
                            <img class="foto1" src="CSS/iconoCI.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="why">
        <div class="whyTitulo">
            <h1>¿Por qué IDEAL?</h1>

        </div>
        <div class="pros">
            <h4>Ponemos a tu disposición a los mejores profesionales</h4>
            <p>Somos centros destacados por la calidad de nuestros tratamientos y por contar con un gran equipo de
                profesionales. En Centros Ideal tenemos un objetivo claro: ayudarte a conseguir el aspecto que deseas,
                para
                que te sientas bien.</p>
        </div>
        <img class="modelo" src="../Vaguada/CSS/modelo1-removebg-preview.png">
        <div class="pros2">
            <h4>Centros de estética avanzada, depilación láser y medicina estética en Centros Ideal</h4>
            <p>En Centros Ideal tenemos más de 10 años de experiencia en el sector de la estética avanzada y medicina
                estética, especializándonos en la depilación láser diodo. Nuestra profesionalidad y trayectoria nos ha
                llevado
                a expandir nuestra marca por todo el panorama nacional con el objetivo de acercar la estética a todo el
                mundo.
            </p>
        </div>
        <div>
            <img class="medicos" src="../Vaguada/CSS/web-para-medicos.png">
        </div>
    </div>
    </div>


    <footer>
        <div>
            <div>
                <p class="p1"><a href="Index.php"><img class="iconoI" src="../Vaguada/CSS/icono_home.png" title="Home"></a> | <a href="depilacion.php">Depilación</a> | <a href="estetica.php">Estética</a>
                    | <a href="medicina.php">Medicina</a> | <a href="centro.php">Centro</a></p>
            </div>
            <div>
                <img class="fotoF" src="../Vaguada/CSS/iconoCI.png">
            </div>
            <div>

                <p class="pF">
                    <a href="privacidad.html">Política de privacidad</a></br>
                    <a href="condiciones.html">Terminos generales del servicio</a></br>

                </p>
            </div>
            </div>

            <div class="RRSS">
                    <a href="https://twitter.com/"><img class="f1" src="../Vaguada/CSS/iconoTwitter-removebg-preview.png"></a>
                    <a href="https://www.facebook.com/"><img class="f2" src="../Vaguada/CSS/iconoFacebook.png.png"></a>
                    <a href="https://www.youtube.com/"><img class="f3" src="../Vaguada/CSS/iconoYoutube.png"></a>
                    <a href="https://www.instagram.com/accounts/login/"><img class="f4" src="../Vaguada/CSS/iconoInstagram.png"></a>
                    <a href="atencion.html"><img class="f4" src="../Vaguada/CSS/iconoAI.png"></a>
                </div>

            <div>
                <p class="pC">Copyright &copy; 2022 1ºDAW |
                    | designed by Santhy Noto, Alejandro Mariategui y David Escanero.</p>
            </div>
        </div>
    </footer>

</body>

<script>
function confirmSubmit() {
    var confirmar = confirm("¿Estás seguro de que quieres enviar el formulario?");
    if (confirmar) {
        // Si el usuario acepta, se devuelve true y el formulario se envía.
        return true;
    } else {
        // Si el usuario cancela, se devuelve false y el formulario no se envía.
        return false;
    }
}
</script>


</html>