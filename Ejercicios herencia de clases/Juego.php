<?php
class Juego extends Soporte {
    private $consola;
    private $minNumJugadores;
    private $maxNumJugadores;

    public function __construct($titulo, $numero, $precio, $consola, $minNumJugadores, $maxNumJugadores) {
        parent::__construct($titulo, $numero, $precio); // Llama al constructor de la clase padre
        $this->consola = $consola;
        $this->minNumJugadores = $minNumJugadores;
        $this->maxNumJugadores = $maxNumJugadores;
    }

    public function getConsola() {
        return $this->consola;
    }

    public function setConsola($consola) {
        $this->consola = $consola;
    }

    public function getMinNumJugadores() {
        return $this->minNumJugadores;
    }

    public function setMinNumJugadores($minNumJugadores) {
        $this->minNumJugadores = $minNumJugadores;
    }

    public function getMaxNumJugadores() {
        return $this->maxNumJugadores;
    }

    public function setMaxNumJugadores($maxNumJugadores) {
        $this->maxNumJugadores = $maxNumJugadores;
    }

    public function muestraJugadoresPosibles() {
        if ($this->minNumJugadores == 1 && $this->maxNumJugadores == 1) {
            echo "Para un jugador";
        } elseif ($this->minNumJugadores == $this->maxNumJugadores) {
            echo "Para " . $this->minNumJugadores . " jugadores";
        } else {
            echo "De " . $this->minNumJugadores . " a " . $this->maxNumJugadores . " jugadores";
        }
    }

    public function muestraResumen() {
        parent::muestraResumen(); // Llama al método muestraResumen de la clase padre
        echo "Consola: " . $this->consola . "<br>";
        echo "Número mínimo de jugadores: " . $this->minNumJugadores . "<br>";
        echo "Número máximo de jugadores: " . $this->maxNumJugadores . "<br>";
        echo "Jugadores posibles: ";
        $this->muestraJugadoresPosibles();
        echo "<br>";
    }
}

?>
