<?php

class contacto{
    private $idContacto;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $telefono;



    function __construct($idContacto, $nombre,$apellido1,$apellido2,$telefono) {
        $this->idContacto = $idContacto;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->telefono = $telefono;        
    }

    public function getidContacto() {
        return $this->idContacto;
    }

    public function getnombre() {
        return $this->nombre;
    }

    public function getapellido1() {
        return $this->apellido1;
    }

    public function getapellido2() {
        return $this->apellido2;
    }

    public function gettelefono() {
        return $this->telefono;
    }

    function __toString() {
        return 'idContacto:'.$this->idContacto .'<br> Nombre: '. $this->nombre. '<br> Apellido1: ' .$this->apellido1. '<br> Apellido2: ' .$this->apellido2. '<br> telefono: '.$this->telefono;
    }
}
