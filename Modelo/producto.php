<?php
    include_once "IProducto.php";
    //  Clase abstracta Producto la cual implementa la interfaz creada en la clase IProducto
    abstract class Producto implements IProducto {
        // Miembros de la clase
        private int $codigo;
        private string $nombre;
        private float $cantidad;
        private float $precioKG;

        private string $origen;
        private float $precioFinal;

        // Constructor de la clase
        public function __construct(int $codigo, string $nombre,float $cantidad, float $precioKG, string $origen) {
            $this->codigo = $codigo;
            $this->nombre = $nombre;
            $this->cantidad = $cantidad;
            $this->precioKG = $precioKG;
            $this->origen = $origen;
            //  Función para calcular el precio final del producto
            $this->calcularPrecioFinal();

        }

        //  Propiedades de la clase
        //  Miembro $codigo
        public function getCodigo(){
            return $this->codigo;
        }
        public function setCodigo(int $codigo){
            $this->codigo = $codigo;
        }

        //  Miembro $nombre
        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre(string $nombre) {
            $this->nombre = $nombre;
        }

        //  Miembro $precioKG
        public function getPrecioKG(){
            return $this->precioKG;
        }
        public function setPrecioKG(float $precioKG) {
            $this->precioKG = $precioKG;
            
        }

        //  Miembro $cantidad
        public function getCantidad(){
            return $this->cantidad;
        }
        public function setCantidad(float $cantidad) {
            $this->cantidad = $cantidad;
        }

        //  Miembro $origen
        public function getOrigen(){
            return $this->origen;
        }
        public function setOrigen(string $origen) {
            $this->origen = $origen;
        } 

        //  Miembro $precioFinal
        public function getPrecioFinal(){
            return $this->precioFinal;
        }
        //  Función para calcular el precio final
        public function calcularPrecioFinal() {
            $this->precioFinal = $this->cantidad * $this->precioKG;
        }
    }
?>
