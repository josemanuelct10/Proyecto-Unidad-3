<?php

// Incluir las clases y funciones necesarias
include_once '../Modelo/pescaderia.php';
include_once '../Modelo/trabajador.php';
include_once '../Validaciones/Validaciones.php';
// Iniciar la sesión
session_start();

$mensaje = '';

// Obtener la instancia de la pescadería de la sesión
$pescaderia = $_SESSION['pescaderia'];

// Validaciones
if (isset($_POST["eliminarTrabajadores"])) {
    $checkBoxs = $_POST["eliminar"];
    $codigosTrabajador = $_POST["codigoTrabajador"];
    $nombresTrabajador = $_POST["nombreTrabajador"];
    $dnisTrabajador = $_POST["dniTrabajador"];
    $telefonosTrabajador = $_POST["telefonoTrabajador"];
    $cargosTrabajador = $_POST["cargoTrabajador"];
    $semanasTrabajadas = $_POST["semanasTrabajadas"];


    // Si no hay errores en las validaciones, proceder a agregar el trabajador
        foreach ($checkBoxs as $codigo => $isChecked) {
            if ($isChecked === "on"){
                $trabajadorEliminado = new Trabajador(
                    $codigosTrabajador[$codigo],
                    $nombresTrabajador[$codigo],
                    $dnisTrabajador[$codigo],
                    $telefonosTrabajador[$codigo],
                    $cargosTrabajador[$codigo],
                    $semanasTrabajadas[$codigo]
                );
    
                $resultado = $pescaderia->rmTrabajador($trabajadorEliminado);
    
                if (!$resultado) {
                    $mensaje = "Error al eliminar los trabajadores.";
                }
            }

        }

        // Actualizar la lista de trabajadores en la pescadería y almacenarla en la sesión
        $_SESSION['pescaderia'] = $pescaderia;

        // Mostrar mensajes de éxito o error
        header("Location: mostrarTrabajadores.php");  // Redirigir automáticamente a la lista de trabajadores en la pescadería
        exit();  // Asegurarse de que no se procese más contenido después de la redirección
    
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
    <h2>Eliminar Trabajadores</h2>
 
    <form class="update" method="post" action="<?php echo($_SERVER["PHP_SELF"]); ?>">
        <table>
            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Dni</th>
                    <th>Telefono</th>
                    <th>Cargo</th>
                    <th>Semanas Trabajadas</th>
                    <th>Sueldo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $listaTrabajadores = $pescaderia->getTrabajadores();
                foreach ($listaTrabajadores as $trabajador) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='eliminar[" . $trabajador->getCodigo() . "]'></td>";
                    echo "<td><input type='text' value='" . $trabajador->getCodigo() . "' required name='codigoTrabajador[" . $trabajador->getCodigo() . "]' readonly></td>";
                    echo "<td><input type='text' value='" . $trabajador->getNombre() . "' required name='nombreTrabajador[" . $trabajador->getCodigo() . "]' readonly></td>";
                    echo "<td><input type='text' value='" . $trabajador->getDni() . "' required name='dniTrabajador[" . $trabajador->getCodigo() . "]' readonly></td>";
                    echo "<td><input type='text' value='" . $trabajador->getTelefono() . "' required name='telefonoTrabajador[" . $trabajador->getCodigo() . "]' readonly></td>";
                    echo "<td><input type='text' value='" . $trabajador->getCargo() . "' required name='cargoTrabajador[" . $trabajador->getCodigo() . "]' readonly></td>";
                    echo "<td><input type='text' value='" . $trabajador->getSemanasTrabajadas() . "' required name='semanasTrabajadas[" . $trabajador->getCodigo() . "] readonly'></td>";
                    echo "<td><input type='text' value='" . $trabajador->getSueldo() . "' name='sueldo[" . $trabajador->getCodigo() . "]' required readonly></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table><br>
        <input type="submit" name="eliminarTrabajadores" value="Eliminar">
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
