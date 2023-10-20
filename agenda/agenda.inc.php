<?php

class agenda {
    private static $contactos = [];

    public static function agregarContacto($parContacto) {
        self::$contactos[] = $parContacto;
    }

    public static function borrarContacto($idContacto) {
        foreach (self::$contactos as $key => $parContacto) {
            if ($parContacto->getIdContacto() == $idContacto) {
                unset(self::$contactos[$key]);
                return;
            }
        }
    }

    public static function mostrarAgendaHTML() {
        $agenda = "";
        foreach (self::$contactos as $parContacto) {
            $agenda .= $parContacto->__toString() . "<br>";
        }
        return $agenda;
    }
    
    

    
}

?>