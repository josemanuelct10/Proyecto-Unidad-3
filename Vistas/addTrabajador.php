<?php


// Incluir las clases y funciones necesarias
include_once '../Modelo/pescaderia.php';
include_once '../Modelo/trabajador.php';
include_once '../Validaciones/Validaciones.php';
// Iniciar la sesión
session_start();

// Obtener la instancia de la pescadería de la sesión
$pescaderia = $_SESSION['pescaderia'];

// Inicializar variables
$mensajeDNI = '';
$mensajeTelefono = '';
$mensajeCodigo = '';

// Validaciones
if (isset($_POST["addTrabajador"])) {
    $codigoTrabajador = $_POST["codigoTrabajador"];
    $nombreTrabajador = $_POST["nombreTrabajador"];
    $dniTrabajador = $_POST["dniTrabajador"];
    $telefonoTrabajador = $_POST["telefonoTrabajador"];
    $cargoTrabajador = $_POST["cargoTrabajador"];
    $semanasTrabajadas = $_POST["semanasTrabajadas"];

    // Validar el DNI utilizando el método validarDNI
    if (!validarDNI($dniTrabajador)) {
        $mensajeDNI = "El DNI ingresado no es válido.";
    }

    // Validar el teléfono utilizando el método validarTelefono
    if (!validarTelefono($telefonoTrabajador)) {
        $mensajeTelefono = "El número de teléfono ingresado no es válido.";
    }

    // Si no hay errores en las validaciones, proceder a agregar el trabajador
    if (empty($mensajeDNI) && empty($mensajeTelefono)) {
        // Crear un nuevo objeto Trabajador
        $nuevoTrabajador = new Trabajador($codigoTrabajador, $nombreTrabajador, $dniTrabajador, $telefonoTrabajador, $cargoTrabajador, $semanasTrabajadas);

        // Agregar el trabajador a la pescadería
        $resultado = $pescaderia->addTrabajador($nuevoTrabajador, false);

        // Actualizar la lista de trabajadores en la pescadería y almacenarla en la sesión
        $_SESSION['pescaderia'] = $pescaderia;

        // Mostrar mensajes de éxito o error
        if ($resultado) {
            header("Location: mostrarTrabajadores.php");  // Redirigir automáticamente a la lista de trabajadores en la pescadería
            exit();  // Asegurarse de que no se procese más contenido después de la redirección
        } else {
            $mensajeCodigo = "El código de trabajador insertado ya existe.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pescados Cañete Trillo - Añadir Trabajador</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="logo.png" sizes="16x16">
    <link rel="icon" type="image/png" href="logo.png" sizes="32x32">
</head>
<body>
    <header>
        <div id="logo">
            <img src="../imagenes/logo.png" alt="Logo de Pescados Cañete Trillo">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="mostrarProductos.php">Productos</a></li>
                <li><a href="pescado.php">Pescado</a></li>
                <li><a href="marisco.php">Marisco</a></li>
                <li><a href="trabajadores.php">Trabajadores</a></li>
            </ul>
        </nav>
        <form method="post" action="buscar_elemento.php">
            <div id="search">
                <input type="text" placeholder="Buscar..." name="codigoNombre">
                <button type="submit">Buscar</button>
            </div>
        </form>
        <form method="post" action="guardarTodo.php">
            <div id="search">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </header>
    <main>
        <form class="add"method="post" action="<?php echo($_SERVER["PHP_SELF"]); ?>">
            <h2>Añadir Trabajador</h2>

            <label for="codigoTrabajador">Código:</label>
            <input type="text" id="codigoTrabajador" name="codigoTrabajador" required value="<?php if((isset($_POST["codigoTrabajador"])) && ($resultado = false)) echo $_POST["codigoTrabajador"];?>"><br><br>
            <?php
            // Mostrar mensaje de error general si existe
            if (!empty($mensajeCodigo)) {
                echo "<p style='color: red;'>$mensajeCodigo</p>";
            }
            ?>


            <label for="nombreTrabajador">Nombre:</label>
            <input type="text" id="nombreTrabajador" name="nombreTrabajador" value="<?php if(isset($_POST["nombreTrabajador"])) echo $_POST["nombreTrabajador"];?>" require><br><br>

            <label for="dniTrabajador">DNI:</label>
            <input type="text" id="dniTrabajador" name="dniTrabajador" required value="<?php if((isset($_POST["dniTrabajador"])) && (empty($mensajeDNI))) echo $_POST["dniTrabajador"];?>">

            <?php
            // Mostrar mensaje de error para el DNI si existe
            if (!empty($mensajeDNI)) {
                echo "<p style='color: red;'>$mensajeDNI</p>";
            }
            ?>



            <label for="telefonoTrabajador">Teléfono:</label>
            <input type="text" id="telefonoTrabajador" name="telefonoTrabajador" value="<?php if((isset($_POST["dniTrabajador"])) && (empty($mensajeTelefono))) echo $_POST["telefonoTrabajador"];?>">
            <?php
            // Mostrar mensaje de error para el teléfono si existe
            if (!empty($mensajeTelefono)) {
                echo "<p style='color: red;'>$mensajeTelefono</p>";
            }
            ?>

            <label for="cargoTrabajador">Cargo:</label>
            <input type="text" id="cargoTrabajador" name="cargoTrabajador" required value="<?php if(isset($_POST["cargoTrabajador"])) echo $_POST["cargoTrabajador"];?>"><br><br>

            <label for="semanasTrabajadas">Semanas Trabajadas:</label>
            <input type="number" id="semanasTrabajadas" name="semanasTrabajadas" required value="<?php if(isset($_POST["semanasTrabajadas"])) echo $_POST["semanasTrabajadas"];?>"><br><br>

      

            <input type="submit" name="addTrabajador" value="Añadir Trabajador"><br><br>
            </form>
    </main>
    <footer>
        <div id="footer-container">
            <div id="footer-list">
                <h3>Enlaces Útiles</h3>
                <ul>
                    <li><a href="#">Aviso Legal</a></li>
                    <li><a href="#">Política de Privacidad</a></li>
                    <li><a href="#">Términos y Condiciones</a></li>
                </ul>
            </div>
            <div id="footer-contact">
                <h3>Contacto</h3>
                <p>Dirección: Calle Principal, Ciudad</p>
                <p>Email: info@pescadoscanetetrillo.com</p>
                <p>Teléfono: +123 456 789</p>
            </div>
        </div>
        <p id="titulo">2023 Pescados Cañete Trillo</p>
    </footer>
</body>
</html>
