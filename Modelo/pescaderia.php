<?php
    class Pescaderia{
        //  Miembros de la clase
        private string $nombre;
        private array $trabajadores;
        private array $productos;

        //  Variable para el patron singleton
        private static $__instancePescaderia;

        //  Constructor de la clase
        private function __construct($nombre){
            $this->nombre = $nombre;
            $this->trabajadores = array();
            $this->productos = [];
        }

        //  Propiedades de la clase
        //  Miembro $nombre
        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        /*
        Funcion que comprueba si la pescadería se ha instanciado o no
        Devuelve la instancia de la pescadería
        Recibe el nombre de la pescadería
        */
        public static function getInstancePescaderia($nombre){
            if(self::$__instancePescaderia == null){
                self::$__instancePescaderia = new Pescaderia($nombre);
            }
            return self::$__instancePescaderia;
        }
        /*
        funcion que comprueba si el objeto Producto que se ha pasado como parámetro, existe en el array productos
        Un objeto ya existe si tiene el mismo codigo y son de la misma clase 
        devuelve true si existe, false si no existe
        */
        private function comprobarProducto(Producto $producto){
            $result = false;
            //$key es el dni de cada elemento 
            foreach ($this->productos as $key => $value){
                
                //si el dni por el que voy comprobando ya existe, devuelvo true
                if($key == $producto->getCodigo() && get_class($value)===get_class($producto)){

                    $result=true;
                    break;
                }
            }
            return $result;
        }

        /*
        funcion que comprueba si el objeto trabajador que se ha pasado como parámetro, existe en el array trabajadores
        Un objeto ya existe si tiene el mismo codigo y son de la misma clase 
        devuelve true si existe, false si no existe
        */
        private function comprobarTrabajador(Trabajador $trabajador){
            $result = false;
            foreach ($this->trabajadores as $key => $value){
                if($key === $trabajador->getCodigo() && get_class($value) === get_class($trabajador)){
                    $result = true;
                    break;
                }
            }
            return $result;
        }

        /*
        Funcion addProducto: añade o modifica un elemento del array
        Recibe: el objeto que quiere añadir o modificar, una variable booleana: $modificar = true si se quiere modificar, $modificar = false cuando se quiere añadiir 
        Devuelve true si se ha podido modificar o añadir y false cuando no se ha podido hacer ninguna de las dos cosas
        */

        public function addProducto(Producto $producto, bool $modificar) {
            if (isset($producto) && ($producto instanceof Producto)) {
                if ($this->comprobarProducto($producto) && !$modificar) {
                    return false;
                } elseif (!$this->comprobarProducto($producto) && $modificar) {
                    return false;
                } else {
                    $this->productos[$producto->getCodigo()] = $producto;
                    return true;
                }
            }
            return false;
        }

        /*
        Funcion addTrabajador: añade o modifica un elemento del array
        Recibe: el objeto que quiere añadir o modificar, una variable booleana: $modificar = true si se quiere modificar, $modificar = false cuando se quiere añadiir 
        Devuelve true si se ha podido modificar o añadir y false cuando no se ha podido hacer ninguna de las dos cosas
        */

        public function addTrabajador(Trabajador $trabajador, bool $modificar) {
            if (isset($trabajador) && ($trabajador instanceof Trabajador)) {
                if ($this->comprobarTrabajador($trabajador) && !$modificar) {
                    return false;
                } elseif (!$this->comprobarTrabajador($trabajador) && $modificar) {
                    return false;
                } else {
                    $this->trabajadores[$trabajador->getCodigo()] = $trabajador;
                    return true;
                }
            }
            return false;
        }


        /*
        Funcion rmProducto: elimina un elemento del array
        Recibe: el objeto que se desea eliminar
        Devuelve true: si se ha eliminado del array false:si no se ha eliminado del array
        */
        public function rmProducto(Producto $producto){
            if(isset($producto)){
                if($this->comprobarProducto($producto)){
                    unset($this->productos[$producto->getCodigo()]); //si existe el elemento lo elimino
                    return true;
                }
            }
            return false;
        }

        /*
        Funcion rmTrabajador: elimina un elemento del array
        Recibe: el objeto que se desea eliminar
        Devuelve true: si se ha eliminado del array false:si no se ha eliminado del array
        */
        public function rmTrabajador(Trabajador $trabajador){
            if(isset($trabajador) && ($trabajador instanceof Trabajador)){
                if($this->comprobarTrabajador($trabajador)){
                    unset($this->trabajadores[$trabajador->getCodigo()]); //si existe el elemento lo elimino
                    return true;
                }
            }
            return false;
        }
        /*
        Funcion getProductos: devolvera el array con todos los productos
        devuelve: el array de productos
        */
        public function getProductos(){
            return $this->productos;
        }

        /*
        Funcion que recibe el codigo del producto
        Devuelve los pescados
        */
        public function getPescados() {
            $pescados = array_filter($this->productos, function($producto) {
                return $producto instanceof Pescado;
            });
        
            return $pescados;
        }
        
        /*
        Funcion que recibe el codigo del producto
        Devuelve los mariscos
        */
        public function getMarisco() {
            $mariscos = array_filter($this->productos, function($producto) {
                return $producto instanceof Marisco;
            });
        
            return $mariscos;
        }
        
        /*
        Funcion getTrabajadores: devolvera el array con todos los trabajadores
        devuelve: el array de trabajadores
        */
        public function getTrabajadores(){
            return $this->trabajadores;
        }

        /*
        Funcion buscarElemento: muestra un producto si solo se le pasa un codigo y muestra un trabajador si se le pasa el codigo junto al nombre
        Recibe: $codigo y $nombre puede ser que si o puede ser que no
        Devuelve: devuelve un objeto de producto si se le pasa solo el codigo, un objeto de trabajador si se le pasa el codigo junto al nombre del mismo y null cuando no se encuentra ningun objeto con los parametros pasados
        */
        public function buscarElemento($codigo, $nombre = null) {
            // Verificar si se proporciona un nombre
            if ($nombre !== null && $nombre !== '') {
                // Buscar un trabajador por código y nombre
                foreach ($this->trabajadores as $trabajador) {
                    $trabajadorCodigo = $trabajador->getCodigo();
                    $trabajadorNombre = $trabajador->getNombre();
        
                    if ($trabajadorCodigo === $codigo && $trabajadorNombre === $nombre) {
                        return $trabajador;
                    }
                }
            } else {
                // Buscar un producto por código
                foreach ($this->productos as $producto) {
                    $productoCodigo = $producto->getCodigo();
        
                    if ($productoCodigo === $codigo) {
                        return $producto;
                    }
                }
            }
            return null; // Retorna null si no se encuentra ningún elemento que coincida con los parámetros proporcionados
        }
    }

    
?>