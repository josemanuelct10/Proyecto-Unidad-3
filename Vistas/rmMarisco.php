<?php
// Incluir las clases y funciones necesarias
include_once '../Modelo/pescaderia.php';
include_once '../Modelo/marisco.php';

// Iniciar la sesión
session_start();

// Obtener la instancia de la pescadería de la sesión
$pescaderia = $_SESSION['pescaderia'];

// Inicializar variables
$mensajeCodigo = '';

// Validaciones
if (isset($_POST["eliminarMariscos"])) {
    // Obtener datos de los mariscos
    $checkBoxs = $_POST["eliminar"];
    $codigosMarisco = $_POST["codigoMarisco"];
    $nombresMarisco = $_POST["nombreMarisco"];
    $cantidadesMarisco = $_POST["cantidadMarisco"];
    $preciosMarisco = $_POST["precioMarisco"];
    $origenesMarisco = $_POST["origenMarisco"];
    $cocidosMarisco = $_POST["cocidoMarisco"];
    $tamaniosMarisco = $_POST["tamanioMarisco"];

    // Actualizar cada marisco
    foreach ($checkBoxs as $codigo => $isChecked) {
        if ($isChecked === "on"){
            // Crear un nuevo objeto con el Marisco actualizado
            $mariscoEliminado = new Marisco(
                $codigosMarisco[$codigo],
                $nombresMarisco[$codigo],
                $cantidadesMarisco[$codigo],
                $preciosMarisco[$codigo],
                $origenesMarisco[$codigo],
                isset($cocidosMarisco[$codigo]) ? true : false,
                $tamaniosMarisco[$codigo]
            );

            // Actualizar el marisco en la pescadería
            $resultado = $pescaderia->rmProducto($mariscoEliminado);

            // Mostrar mensajes de éxito o error
            if (!$resultado) {
                $mensajeCodigo = "Error al eliminar los mariscos.";
                break; // Si falla la actualización de algún marisco, salir del bucle
            }
        }
    }

    // Actualizar la lista de mariscos en la pescadería y almacenarla en la sesión
    $_SESSION['pescaderia'] = $pescaderia;

    // Redirigir automáticamente a la lista de mariscos en la pescadería
    header("Location: mostrarMarisco.php");
    exit();
}

// Función para generar el cuerpo de la tabla HTML
function generarCuerpoTabla($listaMarisco){
    foreach ($listaMarisco as $marisco) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='eliminar[" . $marisco->getCodigo() . "]'></td>";
        echo "<td><input type='text' value='" . $marisco->getCodigo() . "' required name='codigoMarisco[" . $marisco->getCodigo() . "]' readonly></td>";
        echo "<td><input type='text' value='" . $marisco->getNombre() . "' required name='nombreMarisco[" . $marisco->getCodigo() . "]' readonly></td>";
        echo "<td><input type='number' value='" . $marisco->getCantidad() . "' required name='cantidadMarisco[" . $marisco->getCodigo() . "]' readonly></td>";
        echo "<td><input type='number' value='" . $marisco->getPrecioKG() . "' required name='precioMarisco[" . $marisco->getCodigo() . "]' readonly></td>";
        echo "<td><input type='text' value='" . $marisco->getOrigen() . "' required name='origenMarisco[" . $marisco->getCodigo() . "]' readonly></td>";
        // Verificar si es true o false y mostrar "Si" o "No"
        echo "<td><input type='text' value='" . ($marisco->getCocido() ? 'Si' : 'No') . "' name='cocidoMarisco[" . $marisco->getCodigo() . "]' readonly></td>";
        echo "<td><input type='text' value='" . $marisco->getTamanio() . "' required name='tamanioMarisco[" . $marisco->getCodigo() . "]' readonly></td>";
        echo "</tr>";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pescados Cañete Trillo - Actualizar Marisco</title>
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
        <h2>Eliminar Mariscos</h2>
        <form class="update" method="post" action="<?php echo($_SERVER["PHP_SELF"]); ?>">
            <table>
                <thead>
                    <tr>
                        <th>Eliminar</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio del KG</th>
                        <th>Origen</th>
                        <th>Cocido</th>
                        <th>Tamaño</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $listaMarisco = $pescaderia->getMarisco();
                    generarCuerpoTabla($listaMarisco);
                    ?>
                </tbody>
            </table>
            <input type="submit" name="eliminarMariscos" value="Eliminar">
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
