<?php
        include_once '../Modelo/pescaderia.php';
        include_once '../Modelo/trabajador.php';
        include_once '../Modelo/pescado.php';
        include_once '../Modelo/marisco.php';
        session_start();

        // Obtén la instancia de la pescadería de la sesión
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
    <?php
        // Obtén el valor del parámetro 'codigoNombre' enviado por el formulario POST
        $codigoNombre = $_POST['codigoNombre'];
        $nombre = null;
        $numero = null;

        $posicionComa = strpos($codigoNombre, ",");
        if ($posicionComa !== false){
        $numero = substr($codigoNombre, 0, $posicionComa);
        $nombre = trim(substr($codigoNombre, $posicionComa + 1));
        }
        else $numero = $codigoNombre;

        $numeroEntero = intval($numero);

        if ($nombre == null) {$elementoEncontrado = $pescaderia->buscarElemento($numeroEntero);}
        else $elementoEncontrado = $pescaderia->buscarElemento($numeroEntero, $nombre);


        if ($elementoEncontrado !== null) {
            echo '<h2>Elemento encontrado:</h2>';
        
            if ($elementoEncontrado instanceof Pescado) {
                // Si es un Pescado, mostrar una tabla con los atributos de Pescado
                echo '<table border="1">
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
                        <tr>
                            <td>' . $elementoEncontrado->getCodigo() . '</td>
                            <td>' . $elementoEncontrado->getNombre() . '</td>
                            <td>' . $elementoEncontrado->getCantidad() . '</td>
                            <td>' . $elementoEncontrado->getPrecioKG() . '</td>
                            <td>' . $elementoEncontrado->getOrigen() . '</td>
                            <td>' . $elementoEncontrado->getPrecioFinal() . '</td>
                            <td>' . $elementoEncontrado->getProcedencia() . '</td>
                            <td>' . $elementoEncontrado->getPreparacion() . '</td>
                        </tr>
                      </table>';
            } elseif ($elementoEncontrado instanceof Marisco) {
                // Verificar si es true o false y mostrar "Si" o "No"
                $cocido = $elementoEncontrado->getCocido() ? 'Si' : 'No';
                // Si es un Marisco, mostrar una tabla con los atributos de Marisco
                echo '<table border="1">
                        <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Precio del KG</th>
                        <th>Cantidad</th>
                        <th>Origen</th>
                        <th>Cocido</th>
                        <th>Tamaño</th>
                        <th>Precio Final</th>
                        </tr>
                        <tr>
                            <td>' . $elementoEncontrado->getCodigo() . '</td>
                            <td>' . $elementoEncontrado->getNombre() . '</td>
                            <td>' . $elementoEncontrado->getPrecioKG() . '</td>
                            <td>' . $elementoEncontrado->getCantidad() . '</td>
                            <td>' . $elementoEncontrado->getOrigen() . '</td>
                            <td>' . $cocido . '</td>
                            <td>' . $elementoEncontrado->getTamanio() . '</td>
                            <td>' . $elementoEncontrado->getPrecioFinal() . '</td>
                            
                        </tr>
                      </table>';
            } elseif ($elementoEncontrado instanceof Trabajador) {
                // Si es un Trabajador, mostrar una tabla con los atributos de Trabajador
                echo '<table border="1">
                        <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Dni</th>
                        <th>Telefono</th>
                        <th>Cargo</th>
                        <th>Sueldo</th>
                        </tr>
                        <tr>
                            <td>' . $elementoEncontrado->getCodigo() . '</td>
                            <td>' . $elementoEncontrado->getNombre() . '</td>
                            <td>' . $elementoEncontrado->getDni() . '</td>
                            <td>' . $elementoEncontrado->getTelefono() . '</td>
                            <td>' . $elementoEncontrado->getCargo() . '</td>
                            <td>' . $elementoEncontrado->getSueldo() . '</td>
                        </tr>
                      </table>';
            } else {
                // Tipo de objeto desconocido
                echo 'Tipo de objeto desconocido';
            }
        } else {
            echo 'Elemento no encontrado';
        }
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