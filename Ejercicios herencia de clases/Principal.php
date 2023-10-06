<?php
include "Soporte.php";

$soporte1 = new Soporte("Tenet", 22, 3);
$soporte1->muestraResumen();

include "CintaVideo.php";
$miCinta = new CintaVideo("Los cazafantasmas", 23, 3.5, 107);
$miCinta->muestraResumen();

include "Dvd.php";
$miDvd = new Dvd("Origen", 24, 15, "es,en,fr","16:9"); 
$miDvd->muestraResumen();

include "Juego.php";
$miJuego = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1);
$miJuego->muestraResumen();

?>