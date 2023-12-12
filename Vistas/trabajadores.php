<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Productos</title>
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
        <div class="crud-container">
            <section class="section-crud">
                <a href="addTrabajador.php">
                    <img src="../imagenes/add.png" alt="Añadir">
                    <h2>Añadir</h2>
                </a>
            </section>

            <section class="section-crud">
                <a href="rmTrabajador.php">
                    <img src="../imagenes/rm.png" alt="Eliminar">
                    <h2>Eliminar</h2>
                </a>
            </section>

            <section class="section-crud">
                <a href="updateTrabajador.php">
                    <img src="../imagenes/update.png" alt="update">
                    <h2>Actualizar</h2>
                </a>
            </section>
            <section class="section-crud">
                <a href="mostrarTrabajadores.php">
                    <img src="../imagenes/trabajador.png" alt="mostrar">
                    <h2>Mostrar</h2>
                </a> 
        </section>
        </div>
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
