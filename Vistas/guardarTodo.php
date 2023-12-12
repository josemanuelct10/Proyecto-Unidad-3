<?php
// Incluye las clases necesarias
include_once '../Modelo/pescaderia.php';
include_once '../Modelo/pescado.php';
include_once '../Modelo/marisco.php';
include_once '../Modelo/trabajador.php';

// Inicia la sesión
session_start();

// Obtiene la instancia de la pescadería de la sesión
$pescaderia = $_SESSION['pescaderia'];

// Función para guardar los datos de pescados en un archivo XML
function guardarPescado($pescaderia){
    $listaPescados = $pescaderia->getPescados();

    // Crea un nuevo documento XML
    $dom = new DOMDocument('1.0', 'UTF-8');
    $raiz = $dom->createElement('Pescados');
    $dom->appendChild($raiz);

    // Recorre la lista de pescados y crea elementos XML para cada uno
    foreach ($listaPescados as $pescado){
        $elementoPescado = $dom->createElement('Pescado');
        $raiz->appendChild($elementoPescado);
        $elementoPescado->appendChild($dom->createElement('codigo', $pescado->getCodigo()));
        $elementoPescado->appendChild($dom->createElement('nombre', $pescado->getNombre()));
        $elementoPescado->appendChild($dom->createElement('precioKG', $pescado->getPrecioKG()));
        $elementoPescado->appendChild($dom->createElement('cantidad', $pescado->getCantidad()));
        $elementoPescado->appendChild($dom->createElement('origen', $pescado->getOrigen()));
        $elementoPescado->appendChild($dom->createElement('procedencia', $pescado->getProcedencia()));
        $elementoPescado->appendChild($dom->createElement('preparacion', $pescado->getPreparacion()));
    }

    // Guarda el contenido en el archivo XML
    $archivoXML = '../datos/pescado.xml';
    $dom->save($archivoXML);
}

// Función para guardar los datos de mariscos en un archivo XML
function guardarMarisco($pescaderia){
    $listaMariscos = $pescaderia->getMarisco();

    // Crea un nuevo documento XML
    $dom = new DOMDocument('1.0', 'UTF-8');
    $raiz = $dom->createElement('Mariscos');
    $dom->appendChild($raiz);

    // Recorre la lista de mariscos y crea elementos XML para cada uno
    foreach ($listaMariscos as $marisco){
        $elementoMarisco = $dom->createElement('Marisco');
        $raiz->appendChild($elementoMarisco);
        $elementoMarisco->appendChild($dom->createElement('codigo', $marisco->getCodigo()));
        $elementoMarisco->appendChild($dom->createElement('nombre', $marisco->getNombre()));
        $elementoMarisco->appendChild($dom->createElement('precioKG', $marisco->getPrecioKG()));
        $elementoMarisco->appendChild($dom->createElement('cantidad', $marisco->getCantidad()));
        $elementoMarisco->appendChild($dom->createElement('origen', $marisco->getOrigen()));
        $elementoMarisco->appendChild($dom->createElement('cocido', $marisco->getCocido()));
        $elementoMarisco->appendChild($dom->createElement('tamaño', $marisco->getTamanio()));
    }

    // Guarda el contenido en el archivo XML
    $archivoXML = '../datos/marisco.xml';
    $dom->save($archivoXML);
}

// Función para guardar los datos de trabajadores en un archivo XML
function guardarTrabajadores($pescaderia){
    $listaTrabajadores = $pescaderia->getTrabajadores();

    // Crea un nuevo documento XML
    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->formatOutput = true;
    $raiz = $dom->createElement('Trabajadores');
    $dom->appendChild($raiz);

    // Recorre la lista de trabajadores y crea elementos XML para cada uno
    foreach ($listaTrabajadores as $trabajador){
        $elementoTrabajador = $dom->createElement('Trabajador');
        $raiz->appendChild($elementoTrabajador);
        $elementoTrabajador->appendChild($dom->createElement('codigo',$trabajador->getCodigo()));
        $elementoTrabajador->appendChild($dom->createElement('nombre',$trabajador->getNombre()));
        $elementoTrabajador->appendChild($dom->createElement('dni',$trabajador->getDni()));
        $elementoTrabajador->appendChild($dom->createElement('telefono',$trabajador->getTelefono()));
        $elementoTrabajador->appendChild($dom->createElement('cargo',$trabajador->getCargo()));
        $elementoTrabajador->appendChild($dom->createElement('semanasTrabajadas',$trabajador->getSemanasTrabajadas()));
    }

    // Guarda el contenido en el archivo XML
    $archivoXML = '../datos/trabajadores.xml';
    $dom->save($archivoXML);
}

try {
    // Guarda los datos en archivos XML
    guardarPescado($pescaderia);
    guardarTrabajadores($pescaderia);
    guardarMarisco($pescaderia);

    // Redirige a otra página si todo se ejecuta correctamente
    header("Location: index.php");
    exit();
} catch (Exception $e) {
    // En caso de excepción, muestra un mensaje de error o redirige a una página de error
    echo "Error: " . $e->getMessage();
}
?>
