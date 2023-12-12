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

// Validaciones
if (isset($_POST["updatePescado"])) {
    $codigos = $_POST["codigo"];
    $nombres = $_POST["nombre"];
    $precios = $_POST["precio"];
    $cantidades = $_POST["cantidad"];
    $origenes = $_POST["origen"];
    $procedencias = $_POST["procedencia"];
    $preparaciones = $_POST["preparacion"];

    // Actualizar cada pescado

    foreach ($nombres as $index => $nombrePescado) {
        $pescadoActualizado = new Pescado(
            $codigos[$index],
            $nombres[$index],
            $cantidades[$index],
            $precios[$index],
            $origenes[$index],
            $procedencias[$index],
            $preparaciones[$index]
        );
        $resultado = $pescaderia->addProducto($pescadoActualizado, true);
        if (!$resultado) {
            $mensajeCodigo = "Error al actualizar los pescados.";
            break;
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
        echo "<td><input type='text' value='" . $pescado->getCodigo() . "' required name='codigo[]' readonly></td>";
        echo "<td><input type='text' value='" . $pescado->getNombre() . "' required name='nombre[]'></td>";
        echo "<td><input type='number' value='" . $pescado->getCantidad() . "' required name='cantidad[]'></td>";
        echo "<td><input type='number' value='" . $pescado->getPrecioKG() . "' required name='precio[]'></td>";
        echo "<td><input type='text' value='" . $pescado->getOrigen() . "' required name='origen[]'></td>";
        echo "<td><input type='text' value='" . $pescado->getProcedencia() . "' required name='procedencia[]'></td>";
        echo "<td><input type='text' value='" . $pescado->getPreparacion() . "' required name='preparacion[]'></td>";
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
        <h2>Actualizar Pescado</h2>
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
            <input type="submit" name="updatePescado" value="Actualizar">
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
