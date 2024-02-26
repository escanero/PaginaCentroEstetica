<?php
session_start();

// Verifica si se ha enviado el formulario para limpiar el carrito
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["limpiar_carrito"])) {
    unset($_SESSION['carrito']);
}

// Verifica si se ha agregado un producto al carrito
if (isset($_GET['producto']) && isset($_GET['precio'])) {
    $producto = $_GET['producto'];
    $precio = $_GET['precio'];

    // Inicializa el carrito si aún no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    // Agrega el producto y el precio al carrito
    $_SESSION['carrito'][] = array("producto" => $producto, "precio" => $precio);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Carrito-Centros Ideal</title>
    <link rel="icon" href="CSS/logo_ideal_A.png" type="image/x-icon">
</head>

<body>
    <header class="header">
        <div class="head">
            <?php
            // Verifica si el usuario está autenticado
            if (isset($_SESSION['usuario_autenticado']) && $_SESSION['usuario_autenticado'] === true) {
                echo '<div style="text-align: right;">'; // Contenedor con estilo para alinear a la derecha
                echo '<a href="cerrar_sesion.php">Cerrar sesión</a>';
                echo '</div>'; // Cierre del contenedor
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

    <div class="carrito">
        <div class="tuCarrito">
            <div class="tituloCarrito">
                <h2>Carrito de compras</h2>
            </div>
            <form method="post" action="">
            <ul>
                <?php
                $total = 0;
                if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                    foreach ($_SESSION['carrito'] as $indice => $item) {
                        echo '<li><div class="producto">' . $item['producto'] . ' - ' . $item['precio'] . '€' .'</div><div class="icono-eliminar"><a href="#" onclick="eliminarDelCarrito(' . $indice . ')"><span class="material-icons">delete</span></a></div></li>';

                        $total += $item['precio'];
                    }
                } else {
                    echo '<li>Tu carrito de compras está vacío.</li>';
                }
                ?>
            </ul>
            <div class="total">
                <p>Total: <?php echo  number_format($total, 2). '€'; ?></p>
            </div>




                <div class="codigo">


                </div>
                <div class="botonF">
                    <button onclick="mostrarDivPago(event)" class="botonP">Finalizar compra</button>
                </div>





            </form>
        </div>
    </div>

    <div id="divPago" class="div-pago" style="display: none;">
        <h3>Detalles de Pago</h3>
        <div class="total">
                <p>Total: <?php echo number_format($total, 2) . '€'; ?></p>
            </div>
        <form id="formularioPago">
            <!-- Número de Tarjeta -->
            <label for="numeroTarjeta">Número de Tarjeta:</label>
            <input type="text" id="numeroTarjeta" name="numeroTarjeta" placeholder="1234 5678 9012 3456*" required><br>

            <!-- Nombre del Titular -->
            <label for="nombreTitular">Nombre del Titular:</label>
            <input type="text" id="nombreTitular" name="nombreTitular" placeholder="Nombre Apellido*" required><br>

            <!-- Fecha de Vencimiento -->
            <label for="fechaVencimiento">Fecha de Vencimiento:</label>
            <input type="text" id="fechaVencimiento" name="fechaVencimiento" placeholder="MM/AA*" required><br>

            <!-- CVV/CVC -->
            <label for="cvv">CVV/CVC:</label>
            <input type="text" id="cvv" name="cvv" placeholder="123*" required><br>

            <!-- Botón para enviar el formulario -->
            <button type="submit">Procesar Pago</button>
            <button type="button" onclick="cerrarDivPago()">Cancelar</button>
        </form>
    </div>



    <!-- Ventana Modal para Confirmación de Eliminación -->
    <div id="modalConfirmacion" class="modal">
        <div class="modal-content">
            <p>¿Estás seguro de que quieres eliminar este producto del carrito?</p>
            <button id="btnConfirmarEliminar">OK</button>
            <button id="btnDeshacer">Cancelar</button>
        </div>
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
                    <a href="privacidad.html">Política de privacidad</a><br>
                    <a href="condiciones.html">Términos generales del servicio</a><br>
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
    <script>
        function mostrarDivPago(event) {
            event.preventDefault(); // Prevenir el comportamiento predeterminado
            document.getElementById('divPago').style.display = 'block';
        }

        function cerrarDivPago() {
            document.getElementById('divPago').style.display = 'none';
        }



        function eliminarDelCarrito(indiceProducto) {
            var modal = document.getElementById("modalConfirmacion");
            var btnConfirmar = document.getElementById("btnConfirmarEliminar");
            var btnDeshacer = document.getElementById("btnDeshacer");

            // Mostrar la ventana modal
            modal.style.display = "block";

            // Manejar el clic en 'OK'
            btnConfirmar.onclick = function() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        modal.style.display = "none";
                        location.reload(); // Recargar la página para actualizar la lista del carrito
                    }
                };
                xhr.open("GET", "eliminar_del_carrito.php?indice=" + indiceProducto, true);
                xhr.send();
            };

            // Manejar el clic en 'Deshacer'
            btnDeshacer.onclick = function() {
                modal.style.display = "none";
            };
        }
    </script>

</body>

</html>