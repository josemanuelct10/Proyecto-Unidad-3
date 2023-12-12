<?php
// Incluir las clases y funciones necesarias
include_once '../Modelo/pescaderia.php';
include_once '../Modelo/pescado.php';
// Iniciar la sesión
session_start();

// Obtener la instancia de la pescadería de la sesión
$pescaderia = $_SESSION['pescaderia'];

// Inicializar variables
$mensajeCodigo = '';

if (isset($_POST["eliminarPescados"])) {
    $checkBoxs = $_POST["eliminar"];
    $codigos = $_POST["codigo"];
    $nombres = $_POST["nombre"];
    $precios = $_POST["precio"];
    $cantidades = $_POST["cantidad"];
    $origenes = $_POST["origen"];
    $procedencias = $_POST["procedencia"];
    $preparaciones = $_POST["preparacion"];

    foreach ($checkBoxs as $codigo => $isChecked) {
        if ($isChecked === 'on') {
            // Crear una instancia de Pescado con los datos actuales
            $pescadoEliminado = new Pescado(
                $codigos[$codigo],
                $nombres[$codigo],
                $cantidades[$codigo],
                $precios[$codigo],
                $origenes[$codigo],
                $procedencias[$codigo],
                $preparaciones[$codigo]
            );
    
            // Intentar eliminar el pescado de la pescadería
            $resultado = $pescaderia->rmProducto($pescadoEliminado);
    
            // Verificar el resultado de la eliminación
            if (!$resultado) {
                $mensajeCodigo = "Error al eliminar los pescados.";
                break;
            }
        }
    }
    

    // Actualizar la lista de trabajadores en la pescadería y almacenarla en la sesión
    $_SESSION['pescaderia'] = $pescaderia;

    // Mostrar mensajes de éxito o error
    header("Location: mostrarPescado.php");
}

// Función para generar el cuerpo de la tabla HTML
function generarCuerpoTabla($listaPescados)
{
    foreach ($listaPescados as $pescado) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='eliminar[" . $pescado->getCodigo() . "]'></td>";
        echo "<td><input type='text' value='" . $pescado->getCodigo() . "' required name='codigo[" . $pescado->getCodigo() . "]' readonly></td>";
        echo "<td><input type='text' value='" . $pescado->getNombre() . "' required name='nombre[" . $pescado->getCodigo() . "]' readonly></td>";
        echo "<td><input type='number' value='" . $pescado->getCantidad() . "' required name='cantidad[" . $pescado->getCodigo() . "]' readonly></td>";
        echo "<td><input type='number' value='" . $pescado->getPrecioKG() . "' required name='precio[" . $pescado->getCodigo() . "]' readonly></td>";
        echo "<td><input type='text' value='" . $pescado->getOrigen() . "' required name='origen[" . $pescado->getCodigo() . "]' readonly></td>";
        echo "<td><input type='text' value='" . $pescado->getProcedencia() . "' required name='procedencia[" . $pescado->getCodigo() . "]' readonly></td>";
        echo "<td><input type='text' value='" . $pescado->getPreparacion() . "' required name='preparacion[" . $pescado->getCodigo() . "]' readonly></td>";
        echo "</tr>";
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
        <h2>Eliminar Pescado</h2>
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
                        <th>Procedencia</th>
                        <th>Preparacion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $listaPescados = $pescaderia->getPescados();
                    generarCuerpoTabla($listaPescados);
                    ?>
                </tbody>
            </table>
            <input type="submit" name="eliminarPescados" value="Eliminar">
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
