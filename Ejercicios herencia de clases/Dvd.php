<?php
class Dvd extends Soporte {
    private $idiomas;
    private $formatoPantalla;

    public function __construct($titulo, $numero, $precio, $idiomas, $formatoPantalla) {
        parent::__construct($titulo, $numero, $precio); // Llama al constructor de la clase padre
        $this->idiomas = $idiomas;
        $this->formatoPantalla = $formatoPantalla;
    }

    public function getIdiomas() {
        return $this->idiomas;
    }

    public function setIdiomas($idiomas) {
        $this->idiomas = $idiomas;
    }

    public function getFormatoPantalla() {
        return $this->formatoPantalla;
    }

    public function setFormatoPantalla($formatoPantalla) {
        $this->formatoPantalla = $formatoPantalla;
    }

    public function muestraResumen() {
        parent::muestraResumen(); // Llama al método muestraResumen de la clase padre
        echo "Idiomas disponibles: " . $this->idiomas . "<br>";
        echo "Formato de pantalla: " . $this->formatoPantalla . "<br>";
    }
}

?>
