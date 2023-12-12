<?php
// Esta función carga los datos de pescados desde un archivo XML y los agrega a la pescadería
function cargarPescados($pescaderia) {
    $archivoXML = '../datos/pescado.xml';

    // Verifica si el archivo XML existe
    if (file_exists($archivoXML)) {
        // Carga el archivo XML
        $xml = simplexml_load_file($archivoXML);

        // Recorre los elementos hijos del XML
        foreach ($xml->children() as $pescadoXML) {
            // Crea una instancia de la clase Pescado con los datos del XML
            $pescado = new Pescado(
                (int)$pescadoXML->codigo,
                (string)$pescadoXML->nombre,
                (float)$pescadoXML->precioKG,
                (int)$pescadoXML->cantidad,
                (string)$pescadoXML->origen,
                (string)$pescadoXML->procedencia,
                (string)$pescadoXML->preparacion
            );

            // Agrega el pescado a la pescadería
            $pescaderia->addProducto($pescado, false);
        }
    }
}

// Esta función carga los datos de mariscos desde un archivo XML y los agrega a la pescadería
function cargarMariscos($pescaderia){
    $archivoXML = '../datos/marisco.xml';

    // Verifica si el archivo XML existe
    if (file_exists($archivoXML)){
        // Carga el archivo XML
        $xml = simplexml_load_file($archivoXML);

        // Recorre los elementos hijos del XML
        foreach ($xml->children() as $mariscoXML) {
            // Crea una instancia de la clase Marisco con los datos del XML
            $marisco = new Marisco(
                (int)$mariscoXML->codigo,
                (string)$mariscoXML->nombre,
                (int)$mariscoXML->cantidad,
                (float)$mariscoXML->precioKG,
                (string)$mariscoXML->origen,
                ((int)$mariscoXML->cocido == 1 ? true : false),
                (string)$mariscoXML->tamaño
            );

            // Agrega el marisco a la pescadería
            $pescaderia->addProducto($marisco, false);
        }
    }
}

// Esta función carga los datos de trabajadores desde un archivo XML y los agrega a la pescadería
function cargarTrabajadores($pescaderia){
    $archivoXML = '../datos/trabajadores.xml';

    // Verifica si el archivo XML existe
    if (file_exists($archivoXML)){
        // Carga el archivo XML
        $xml = simplexml_load_file($archivoXML);

        // Recorre los elementos hijos del XML
        foreach ($xml->children() as $trabajadoresXML) {
            // Crea una instancia de la clase Trabajador con los datos del XML
            $trabajador = new Trabajador(
                (int)$trabajadoresXML->codigo,
                (string)$trabajadoresXML->nombre,
                (string)$trabajadoresXML->dni,
                (string)$trabajadoresXML->telefono,
                (string)$trabajadoresXML->cargo,
                (int)$trabajadoresXML->semanasTrabajadas
            );

            // Agrega el trabajador a la pescadería
            $pescaderia->addTrabajador($trabajador, false);
        }
    }
}
?>
