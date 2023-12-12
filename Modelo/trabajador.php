<?php
    require_once "ITrabajador.php";
    //  Clase Trabajador la cual implementa la interfaz creada en la clase ITrabajador
    class Trabajador implements ITrabajador {
        //  Miembros de la clase
        private int $codigo;
        private string $nombre;
        private string $dni;
        private string $telefono;
        private float $sueldo;  //  Se calculará mensualmente
        private string $cargo;
        private int $semanasTrabajadas;

        // Constructor de la clase
        public function __construct(int $codigo, string $nombre, string $dni, string $telefono, string $cargo, int $semanasTrabajadas) {
            $this->codigo = $codigo;
            $this->nombre = $nombre;
            $this->dni = $dni;
            $this->telefono = $telefono;
            $this->cargo = $cargo;
            $this->semanasTrabajadas = $semanasTrabajadas;
            //  Función para calcular sueldo del trabajador
            $this->calcularSueldo();
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
        public function setNombre(string $nombre){
            $this->nombre = $nombre;
        }

        //  Miembro $dni
        public function getDni(){
            return $this->dni;
        }
        public function setDni(int $dni) {
            $this->dni = $dni;
        }

        //  Miembro $telefono
        public function getTelefono(){
            return $this->telefono;
        }
        public function setTelefono(string $telefono){
            $this->telefono = $telefono;
        }

        //  Miembro $sueldo
        public function getSueldo(){
            return $this->sueldo;
        }
        //  Función para calcular el sueldo mensual del trabajador
        public function calcularSueldo(){
            
            $semanasTrabajadas = $this->getSemanasTrabajadas();
            $sueldoSemanal = 270;
            $sueldoFinal = $semanasTrabajadas * $sueldoSemanal;

            $this->sueldo = $sueldoFinal;
        }

        //  Miembro $cargo
        public function getCargo(){
            return $this->cargo;
        }
        public function setCargo(string $cargo){
            $this->cargo = $cargo;
        }

        //  Miembro $semanasTrabajadas
        public function getSemanasTrabajadas(){
            return $this->semanasTrabajadas;
        }
        public function setSemanasTrabajadas(int $semanasTrabajadas){
            $this->semanasTrabajadas = $semanasTrabajadas;
        }
    }    
?>