<?php
session_start();

// Inicializa las variables de mensaje de éxito y error
$success_message = '';
$error_message = '';
$success_messageR = '';
$error_messageR = '';

// Establece la conexión con la base de datos (ajusta estos valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "marsupilami00";
$dbname = "ideal";

// Conecta a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica si la conexión a la base de datos tuvo éxito
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Comprueba si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login"])) {
        // Procesar el formulario de inicio de sesión
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Prepara la consulta para la autenticación del usuario
        $stmt = $conn->prepare("SELECT pass FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            // Compara la contraseña ingresada con la almacenada en la base de datos
            if ($pass === $user['pass']) {
                $_SESSION['usuario_autenticado'] = true;
                $_SESSION['email'] = $email;
               
        
                // Autenticación exitosa, redirige al usuario a su página de inicio
                header("Location: Index.php");
                exit;
            } else {
                $error_message = "Autenticación fallida. Por favor, verifica tu correo y contraseña.";
            }
        } else {
            $error_message = "Autenticación fallida. Por favor, verifica tu correo y contraseña.";
        }
        $stmt->close();
    } elseif (isset($_POST["registro"])) {
        // Procesar el formulario de registro
        $nombre = $_POST["nombreR"];
        $apellido = $_POST["apellidoR"];
        $email = $_POST["emailR"];
        $pass = $_POST["passR"];

        // Valida los datos (puedes agregar más validaciones según tus necesidades)
        if (!empty($nombre) && !empty($apellido) && !empty($email) && !empty($pass)) {

            // Verifica si el correo ya está registrado
            $stmt = $conn->prepare("SELECT email FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $error_messageR = "El correo electrónico ya está registrado. Por favor, utiliza otro.";
            } else {
                // Si no está registrado, inserta los datos en la tabla con una contraseña hasheada
                $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
                $insertStmt = $conn->prepare("INSERT INTO usuarios (nombre, apellido, email, pass) VALUES (?, ?, ?, ?)");
                $insertStmt->bind_param("ssss", $nombre, $apellido, $email, $pass);

                if ($insertStmt->execute()) {
                    $success_messageR = "Registro completado correctamente.";
                } else {
                    $error_messageR = "Error al ingresar los datos: " . $conn->error;
                }
                $insertStmt->close();
            }
            $stmt->close();
        } else {
            $error_messageR = "Todos los campos son requeridos.";
        }
    }
}

// Cierra la conexión a la base de datos al final del script
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Log In-Centros Ideal</title>
    <link rel="icon" href="CSS/logo_ideal_A.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans&display=swap" rel="stylesheet">
    <script src="formulario.js"></script>

</head>

<body>
    <header class="header">
        <div class="head">
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


    


    <div class="clogIn">
    <div class="tabs">

        </div>
        <form action="" method="post" class="formularioL">
            <?php if (!empty($error_message)) : ?>
                <div class="error"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <div class="padre3">
                <div class="correo">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Email*" required>
                </div>
                <div class="clave">
                    <label for="pass">Contraseña</label>
                    <input type="password" id="pass" name="pass" placeholder="Contraseña*" required>
                    <div class="remember">
                        <input class="checkbox2" type="checkbox" id="recuerdame" name="recuerdame">
                        Recuérdame
                    </div>
                </div>
                <div class="condiciones4">
                    <p style="color: #96099b;"><a href="#">¿Olvidaste la Contraseña?</a></p>
                    <input class="botonL" type="submit" value="Log-In" name="login"><br><br><br>
                    <a href="#" class="registro" id="registerTab" onclick="mostrarFormulario('register')">¿No tienes cuenta? Registrate</a>
                </div>





            </div>
        </form>


        <form action="" class="formularioR" method="post">
            <?php if (!empty($error_message)) : ?>
                <div class="error"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <?php if (!empty($error_messageR)) : ?>
                <div class="error"><?php echo $error_messageR; ?></div>
            <?php endif; ?>

            <?php if (!empty($success_messageR)) : ?>
                <div class="success"><?php echo $success_messageR; ?></div>
            <?php endif; ?>
            <div class="padre3">
                <div class="nombre">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombreR" placeholder="Nombre*" required value="<?php echo isset($_POST['nombreR']) ? htmlspecialchars($_POST['nombreR']) : ''; ?>">
                </div>
                <div class="apellido">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellidoR" placeholder="Apellidos*" required value="<?php echo isset($_POST['apellidoR']) ? htmlspecialchars($_POST['apellidoR']) : ''; ?>">
                </div>
                <div class="correo">
                    <label for="email">Email</label>
                    <input type="email" name="emailR" placeholder="Email*" required value="<?php echo isset($_POST['emailR']) ? htmlspecialchars($_POST['emailR']) : ''; ?>" <?php if (!empty($error_messageR) && strpos($error_messageR, 'correo electrónico') !== false) echo 'style="border: 2px solid red;"'; ?>>

                </div>
                <div class="clave">
                    <label for="pass">Contraseña</label>
                    <input type="password" id="passR" name="passR" placeholder="Contraseña*" pattern="(?=.*[A-Z]).{8,}" title="La contraseña debe tener al menos 8 caracteres y una letra mayúscula." required>
                </div>
                <div class="condiciones4">

                    <input class="botonL" type="submit" value="Registrate" name="registro"><br><br><br>
                    <a href="#" class="login" id="loginTab" onclick="mostrarFormulario('login')">¿Ya tienes una cuenta? Iniciar Sesión</a>
                </div>


            </div>
        </form>
        

    </div>



    <footer class="footer4">
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