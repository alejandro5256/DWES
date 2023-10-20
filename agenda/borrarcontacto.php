<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $idContacto = $_GET['id'];

    // Conecta a la base de datos
    $conexion = new mysqli('localhost', 'agenda', 'agenda', 'agenda');
    if ($conexion->connect_error) {
        echo "Error de conexión: " . $conexion->connect_error;
    } else {
        // Verifica si el ID de contacto existe en la base de datos
        $consulta = $conexion->prepare("SELECT idContacto FROM contactos WHERE idContacto = ?");
        $consulta->bind_param("i", $idContacto);
        $consulta->execute();
        $consulta->store_result();

        if ($consulta->num_rows == 1) {
            // El ID de contacto existe, procede a eliminarlo
            $borrarConsulta = $conexion->prepare("DELETE FROM contactos WHERE idContacto = ?");
            $borrarConsulta->bind_param("i", $idContacto);

            if ($borrarConsulta->execute()) {
                echo "Contacto eliminado correctamente.";
            } else {
                echo "Error, no se ha podido eliminar el contacto." . $conexion->error;
            }

            $borrarConsulta->close();
        } else {
            echo "El ID de contacto no existe en la base de datos.";
        }

        $consulta->close();
        $conexion->close();
    }
} else {
    echo "No se proporcionó un ID válido para eliminar el contacto.";
}

// Redirecciona a contactonuevo.php después de la eliminación o en caso de error
header("Location: contactonuevo.php");
exit;
?>
