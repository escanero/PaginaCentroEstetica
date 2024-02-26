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
            $error_message = "El email ya está registrado en la base de datos.";
        } else {
            // Inserta los datos en la tabla
            $sql = "INSERT INTO prueba (nombre, email, telefono) VALUES ('$nombre', '$email', '$telefono')";

            if ($conn->query($sql) === TRUE) {
                $success_message = "Datos ingresados correctamente.";
            } else {
                $error_message = "Error al ingresar los datos: " . $conn->error;
            }
        }

        
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
    <title>Centro La Vaguada</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="icon" href="CSS/logo_ideal_A.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="head">
            <?php
            
            if (isset($_SESSION['usuario_autenticado']) && $_SESSION['usuario_autenticado'] === true) {
                echo '<div style="text-align: right;">'; 
                echo '<a class="cerrarSesion" href="cerrar_sesion.php">Cerrar sesión</a>';
                echo '</div>'; 
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
                <a href="Index.php"><img class="fotoH1" src="CSS/WhatsApp Image 2023-10-10 at 08.50.38.jpeg" title="Centros Ideal"></a>
            </div>
        </div>
        <div id="menu2">
            <ul class="menuV">
                <li><a href="Index.php">Inicio</a></li>


                <li><a href="depilacion.php">Depilación</a>
                    <ul class="menu-vertical">
                        <li><a href="depilacion.php">Depilación láser para ellas</a></li>
                        <li><a href="depilacion.php">Depilación láser para ellos</a></li>
                        <li><a href="depilacion.php">Nuestra tecnología</a></li>
                        <li><a href="#">Precios</a></li>
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

    <div class="video"><iframe width="700" height="430" src="https://www.youtube.com/embed/JtHvwaPPOlU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>


        <form action="" class="formulario5" method="post" onsubmit="return confirmSubmit()">
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





    <div class="datos">
        <div class="addres">
            <div>
                <div class="iconoA"><img src="../Vaguada/CSS/iconoUbi-removebg-preview.png" width="50px"></div>
                <div class="parrafo">

                    <p>
                        Centro comercial La Vaguada:<br>
                        Avenida Monforte de Lemos 36,<br>
                        28029 Madrid</p>
                </div>

            </div>
        </div>
        <div class="addresE">
    <div class="iconoAB"><img src="../Vaguada/CSS/iconEmail-removebg-preview.png" width="50px"></div>
    <div class="parrafoE">
        <!-- Enlace para enviar email -->
        <a href="mailto:cclavaguada@centrosideal.com">
            <p>cclavaguada@centrosideal.com</p>
        </a>
    </div>
</div>

        <div class="movil">
            <div class="iconoA"><img src="../Vaguada/CSS/phone-icon-removebg-preview.png" width="40px"></div>
            <div class="parrafoM1">
                <p>916861723 / 630282988</p>
            </div>
           
        </div>
        <div class="metro">
            <div class="iconoAM"><img src="../Vaguada/CSS/transporte.png" width="90px"></div>
            <div class="parrafoM2">

                <p>Metro: Linea 9 Barrio del Pilar.<br><br>
                    Autobuses: 133/147/67/83</p>
            </div>


        </div>
        <div class="horario">
            <div>
                <p>Lunes</p>
            </div>
            <div>
                <p> 10:00 - 22:00</p>
            </div>
            <div>
                <p>Martes</p>
            </div>
            <div>
                <p> 10:00 - 22:00</p>
            </div>
            <div>
                <p>Miércoles</p>
            </div>
            <div>
                <p> 10:00 - 22:00</p>
            </div>
            <div>
                <p>Jueves</p>
            </div>
            <div>
                <p> 10:00 - 22:00</p>
            </div>
            <div>
                <p>Viernes</p>
            </div>
            <div>
                <p> 10:00 - 22:00</p>
            </div>
            <div>
                <p>Sabado</p>
            </div>
            <div>
                <p> 10:00 - 22:00</p>
            </div>
            <div>
                <p>Domingo</p>
            </div>
            <div>
                <p> 11:00 - 21:00</p>
            </div>
            <div>
                <p>Festivos</p>
            </div>
            <div>
                <p> 11:00 - 21:00</p>
            </div>

        </div>

        <div class="mapa">
            <div class="mapa1">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3034.7913927507607!2d-3.7099667240511818!3d40.47987982142953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd42299ea90534b7%3A0xccee98581c84edbe!2sLa%20Vaguada%20Shopping%20Center!5e0!3m2!1sen!2ses!4v1669824631014!5m2!1sen!2ses" width="850" height="310" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        
    </div>
       

        <footer class="footer6">
            <div>
                <div>
                    <p class="p1"><a href="Index.php"><img class="iconoI" src="../Vaguada/CSS/icono_home.png"></a> | <a href="depilacion.php">Depilación</a> | <a href="estetica.php">Estética</a>
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

</html>