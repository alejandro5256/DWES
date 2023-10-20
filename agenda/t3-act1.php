<?php
include 'agenda.inc.php';
include 'contacto.inc.php';

$agenda = new agenda();

$contacto1 = new contacto(1, 'Juan', 'Perez', 'Gomez', '123-456-7890 <br>');
$contacto2 = new contacto(2, 'María', 'Lopez', 'Rodriguez', '987-654-3210 <br>');
$contacto3 = new contacto(3, 'Alex', 'Escribano', 'Sanchez', '111-258-456 <br>');

// Agregar contactos a la agenda
agenda::agregarContacto($contacto1);
agenda::agregarContacto($contacto2);
agenda::agregarContacto($contacto3);

// Mostrar la agenda en HTML
echo "<h2>Agenda antes de eliminar:</h2>";
echo $agenda->mostrarAgendaHTML();

// Borrar un contacto

agenda::borrarContacto(3);

// Mostrar la agenda nuevamente después de borrar
echo "<h2>Agenda despues de eliminar:</h2>";
echo agenda::mostrarAgendaHTML();




?>