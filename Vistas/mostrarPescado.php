<?php
    include_once '../Modelo/pescaderia.php';
    include_once '../Modelo/pescado.php';

    session_start();
    $pescaderia = $_SESSION['pescaderia'];
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
        <h2>Lista de Pescados</h2>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio del KG</th>
                    <th>Origen</th>
                    <th>Precio Final</th>
                    <th>Procedencia</th>
                    <th>Preparacion</th>


                </tr>
            </thead>
            <tbody>
                <?php
                    $listaPescados = $pescaderia->getPescados();
                    foreach ($listaPescados as $pescado) {
                        echo "<tr>";
                        echo "<td>" . $pescado->getCodigo() . "</td>";
                        echo "<td>" . $pescado->getNombre() . "</td>";
                        echo "<td>" . $pescado->getCantidad() . "</td>";
                        echo "<td>" . $pescado->getPrecioKG() . "€</td>";
                        echo "<td>" . $pescado->getOrigen() . "</td>";
                        echo "<td>" . $pescado->getPrecioFinal() . "€</td>";
                        echo "<td>" . $pescado->getProcedencia() . "</td>";
                        echo "<td>" . $pescado->getPreparacion() . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
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
