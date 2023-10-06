<?php

class CintaVideo extends Soporte{

    public $duracion;


    public function __construct ($titulo,$numero,$precio,$duracion) {
        parent::__construct($titulo,$numero,$precio);
        $this->duracion = $duracion;
        }

        public function getDuracion() {
            return $this->duracion;
        }
    
        public function setDuracion($duracion) {
            $this->duracion = $duracion;
        }

        public function muestraResumen() {
            parent::muestraResumen(); // Llama al método muestraResumen de la clase padre
            echo "Duración: " . $this->duracion . " minutos<br>";
        }

}


?>