<?php
    include_once "producto.php";
    //  Clase Pescado que extiende/hereda de la clase Producto
    class Pescado extends Producto {
        //  Miembros de la clase Marisco
        private string $procedencia;
        private string $preparacion;
        
        //  Constructor de la clase
        //  Hereda el constructor de la clase padre (Producto)
        public function __construct(int $codigo, string $nombre, float $cantidad, float $precioKG, string $origen, string $procedencia, string $preparacion) {
            parent::__construct($codigo, $nombre, $cantidad, $precioKG, $origen);
            $this->procedencia = $procedencia;
            $this->preparacion = $preparacion;
        }

        //  Propiedades de la clase
        //  Miembro $procedencia
        public function getProcedencia(): string {
            return $this->procedencia;
        }
        public function setProcedencia(string $procedencia) {
            $this->procedencia = $procedencia;
        }

        //  Miembro $preparacion
        public function getPreparacion(): string {
            return $this->preparacion;
        }
        public function setPreparacion(string $preparacion) {
            $this->preparacion = $preparacion;
        } 
    }
?>