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
if (isset($_POST["updateTrabajador"])) {
    $codigosTrabajador = $_POST["codigoTrabajador"];
    $nombresTrabajador = $_POST["nombreTrabajador"];
    $dnisTrabajador = $_POST["dniTrabajador"];
    $telefonosTrabajador = $_POST["telefonoTrabajador"];
    $cargosTrabajador = $_POST["cargoTrabajador"];
    $semanasTrabajadas = $_POST["semanasTrabajadas"];


    foreach ($telefonosTrabajador as $telefono) {
        // Validar el teléfono utilizando el método validarTelefono
        if (!validarTelefono($telefono)) {
            $mensaje = "El número de teléfono ingresado no es válido.";
            break; // Detener el bucle si hay un teléfono no válido
        }
    }

    // Si no hay errores en las validaciones, proceder a agregar el trabajador
    if (empty($mensaje)) {
        foreach ($nombresTrabajador as $index => $trabajador) {
            $trabajadorActualizado = new Trabajador(
                $codigosTrabajador[$index],
                $nombresTrabajador[$index],
                $dnisTrabajador[$index],
                $telefonosTrabajador[$index],
                $cargosTrabajador[$index],
                $semanasTrabajadas[$index]
            );

            $resultado = $pescaderia->addTrabajador($trabajadorActualizado, true);

            if (!$resultado) {
                $mensaje = "Error al actualizar los trabajadores.";
            }
        }

        // Actualizar la lista de trabajadores en la pescadería y almacenarla en la sesión
        $_SESSION['pescaderia'] = $pescaderia;

        // Mostrar mensajes de éxito o error
        header("Location: mostrarTrabajadores.php");  // Redirigir automáticamente a la lista de trabajadores en la pescadería
        exit();  // Asegurarse de que no se procese más contenido después de la redirección
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Manejar el evento de entrada en el campo de búsqueda
            $('#search input[name="codigoNombre"]').on('input', function() {
                // Obtener el valor del campo de búsqueda
                var searchTerm = $(this).val().toLowerCase();

                // Filtrar la tabla según el término de búsqueda
                $('table tbody tr').each(function() {
                    var nombre = $(this).find('td:eq(1) input').val().toLowerCase();

                    // Mostrar u ocultar la fila según si coincide con la búsqueda
                    $(this).toggle(nombre.includes(searchTerm));
                });
            });
        });
    </script>
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
    <h2>Actualizacion de Trabajadores</h2>
    <form class="buscadorInstantaneo" method="post" action="buscar_elemento.php">
        <div id="search">
            <input type="text" placeholder="Buscar..." name="codigoNombre">
        </div>
    </form>    
    <form class="update" method="post" action="<?php echo($_SERVER["PHP_SELF"]); ?>">
        <table>
            <thead>
                <tr>
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
                $contador = 0;
                foreach ($listaTrabajadores as $trabajador) {
                    echo "<tr>";
                    echo "<td><input type='text' value='" . $trabajador->getCodigo() . "' required name='codigoTrabajador[]' readonly></td>";
                    echo "<td><input type='text' value='" . $trabajador->getNombre() . "' required name='nombreTrabajador[]'></td>";
                    echo "<td><input type='text' value='" . $trabajador->getDni() . "' required name='dniTrabajador[]' readonly></td>";
                    echo "<td><input type='text' value='" . $trabajador->getTelefono() . "' required name='telefonoTrabajador[]'></td>";
                    // Mostrar mensaje de error general si existe
                    if (!empty($mensaje) && $contador == 0) {
                        echo "<p style='color: red;'>$mensaje</p>";
                        $contador++;
                    }
                    echo "<td><input type='text' value='" . $trabajador->getCargo() . "' required name='cargoTrabajador[]'></td>";
                    echo "<td><input type='text' value='" . $trabajador->getSemanasTrabajadas() . "' required name='semanasTrabajadas[]'></td>";
                    echo "<td><input type='text' value='" . $trabajador->getSueldo() . "' name='sueldo[]' required readonly></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table><br>
        <input type="submit" name="updateTrabajador" value="Actualizar">
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
