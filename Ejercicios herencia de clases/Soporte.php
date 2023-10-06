<?php
class Soporte {
    private $titulo;
    private $numero;
    private $precio;
    private $precioConIva; 
    private const IVA = 0.21; // Valor del IVA al 21%

    public function __construct($titulo, $numero, $precio) {
        $this->titulo = $titulo;
        $this->numero = $numero;
        $this->precio = $precio;
        $this->precioConIva = $precio * (1 + self::IVA); // Calculamos el precio con IVA al construir el objeto

    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function getPrecioConIva() {
        return $this->precioConIva;
    }

    public function muestraResumen() {
        $precioConIva = $this->precio * (1 + self::IVA);
        echo "Título: " . $this->titulo . "<br>";
        echo "Número: " . $this->numero . "<br>";
        echo "Precio (sin IVA): $" . $this->precio . "<br>";
        echo "Precio (con IVA al 21%): $" . number_format($precioConIva, 2) . "<br>";
    }
}



?>