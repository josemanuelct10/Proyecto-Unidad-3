<?php

include_once '../Modelo/pescaderia.php';
include_once '../Modelo/marisco.php';
session_start();
$pescaderia = $_SESSION['pescaderia'];

$mensajeCodigo = "";

// Validacion y creacion del produto
if (isset($_POST["addMarisco"])){
    $codigoMarisco = $_POST["codigoMarisco"];
    $nombreMarisco = $_POST["nombreMarisco"];
    $cantidadMarisco = $_POST["cantidadMarisco"];
    $precioMarisco = $_POST["precioMarisco"];
    $origenMarisco = $_POST["origenMarisco"];
    $cocidoMarisco = isset($_POST["cocidoMarisco"]) ? true : false;
    $tamanioMarisco = $_POST["tamanioMarisco"];

    // Crear un nuevo objeto Marisco
    $nuevoMarisco = new Marisco($codigoMarisco, $nombreMarisco, $cantidadMarisco, $precioMarisco,  $origenMarisco, $cocidoMarisco, $tamanioMarisco);

    // Agregar el marisco a la pescadería
    $resultado = $pescaderia->addProducto($nuevoMarisco, false);

    // Actualizar la lista de mariscos en la pescadería y almacenarla en la sesión
    $_SESSION['pescaderia'] = $pescaderia;

    if ($resultado){
        header("Location: mostrarMarisco.php");
        exit();
    }
    else{
        $mensajeCodigo = "El codigo del marisco insertado ya existe";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pescados Cañete Trillo - Añadir Marisco</title>
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
        <form class="add" method="post" action="<?php echo($_SERVER["PHP_SELF"]); ?>">
            <h2>Añadir Marisco</h2>
            <label for="codigoMarisco">Código:</label>
            <input type="text" id="codigoMarisco" name="codigoMarisco" required><br>
            <?php
            if (!empty($mensajeCodigo)){
                echo "<p style='color: red;'>$mensajeCodigo</p>";
            }
            ?>

            <label for="nombreMarisco">Nombre:</label>
            <input type="text" id="nombreMarisco" name="nombreMarisco" value="<?php if(isset($_POST["nombreMarisco"])) echo $_POST["nombreMarisco"];?>" required><br>

            <label for="precioMarisco">Precio del Kilogramo:</label>
            <input type="number" id="precioMarisco" name="precioMarisco" step="0.01" value="<?php if(isset($_POST["precioMarisco"])) echo $_POST["precioMarisco"];?>" required><br>

            <label for="cantidadMarisco">Cantidad:</label>
            <input type="number" id="cantidadMarisco" name="cantidadMarisco" value="<?php if(isset($_POST["cantidadMarisco"])) echo $_POST["cantidadMarisco"];?>" required><br>

            <label for="origenMarisco">Origen:</label>
            <input type="text" id="origenMarisco" name="origenMarisco" value="<?php if(isset($_POST["origenMarisco"])) echo $_POST["origenMarisco"];?>" required><br>
            <label for="tamanioMarisco">Tamaño:</label>
            <input type="text" id="tamanioMarisco" name="tamanioMarisco" value="<?php if(isset($_POST["tamanioMarisco"])) echo $_POST["tamanioMarisco"];?>" required><br>

            Cocido: <input type="checkbox" name="cocidoMarisco" <?php if((isset($_POST["origenMarisco"])) && ($_POST["origenMarisco"] == true)) echo "checked"; ?>><br>



            <input type="submit" name="addMarisco" value="Añadir Marisco"><br><br>
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
