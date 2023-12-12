<?php
include_once '../Modelo/pescaderia.php';
include_once '../Modelo/pescado.php';

session_start();
$pescaderia = $_SESSION['pescaderia'];

// Inicializacion de variables
$mensajeCodigo = "";

// Obtener y procesar los datos del formulario
if (isset($_POST["addPescado"])) {
    // Procesar el formulario cuando se envía
    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];
    $origen = $_POST["origen"];
    $procedencia = $_POST["procedencia"];
    $preparacion = $_POST["preparacion"];

    // Aquí puedes utilizar los datos como desees, por ejemplo, crear un nuevo objeto Pescado
    $nuevoPescado = new Pescado($codigo, $nombre, $cantidad, $precio, $origen, $procedencia, $preparacion);

    // Se crea un nuevo producto y se guardara en el resultado true->si se ha creado correctamente y false->si no se ha podido crear
    $resultado = $pescaderia->addProducto($nuevoPescado, false);

    // Actualiza la lista de pescados en la pescadería y almacénala en la sesión
    $_SESSION['pescaderia'] = $pescaderia;

    // Guardar Nuevo objeto en el archivo xml
    if ($resultado) {
        header("Location: mostrarPescado.php");
        exit();
    } else {
        $mensajeCodigo = "El código del pescado insertado ya existe.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pescados Cañete Trillo</title>
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
                <li><a href="Index.php">Inicio</a></li>
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
        <h2>Añadir Pescado</h2>
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" required><br>
            <?php
            // Mostrar mensaje de error general si existe
            if (!empty($mensajeCodigo)) {
                echo "<p style='color: red;'>$mensajeCodigo</p>";
            }
            ?>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre"  value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>" required><br>

            <label for="precio">Precio del Kilogramo:</label>
            <input type="number" id="precio" name="precio" step="0.01"  value="<?php if(isset($_POST["precio"])) echo $_POST["precio"];?>" required><br>

            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad"  value="<?php if(isset($_POST["cantidad"])) echo $_POST["cantidad"];?>" required><br>

            <label for="origen">Origen:</label>
            <input type="text" id="origen" name="origen"  value="<?php if(isset($_POST["origen"])) echo $_POST["origen"];?>" required><br>

            <label for="procedencia">Procedencia:</label>
            <input type="text" id="procedencia" name="procedencia"  value="<?php if(isset($_POST["procedencia"])) echo $_POST["procedencia"];?>" required><br>

            <label for="preparacion">Preparación:</label>
            <textarea id="preparacion" name="preparacion" rows="4" required></textarea><br>

            <input type="submit" name="addPescado" value="Añadir Pescado" ><br><br>
        </form>

        <?php

?>
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
