<?php
    include_once "producto.php";
    //  Clase Marisco que extiende/hereda de la clase Producto
    class Marisco extends Producto {
        //  Miembros de la clase Marisco
        private bool $cocido;
        private string $tamanio;

        //  Constructor de la clase
        //  Hereda el constructor de la clase padre (Producto)
        public function __construct(int $codigo, string $nombre, float $cantidad, float $precioKG, string $origen, bool $cocido, string $tamanio) {
            parent::__construct($codigo, $nombre, $cantidad, $precioKG, $origen);
            $this->cocido = $cocido;
            $this->tamanio = $tamanio;
        }

        //  Propiedades de la clase
        //  Miembro $cocido
        public function getCocido(): bool {
            return $this->cocido;
        }
        public function setCocido(bool $cocido) {
            $this->cocido = $cocido;
        }

        //  Miembro $tamanio
        public function getTamanio(): string {
            return $this->tamanio;
        }
        public function setTamanio(string $tamanio) {
            $this->tamanio = $tamanio;
        }
    }
?>