<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['stock'])) {
    $cod = $_GET['stock'];

    // Conecta a la base de datos
    $conexion = new mysqli('localhost', 'dwes', 'dwes', 'dwes');
    if ($conexion->connect_error) {
        echo "Error de conexión: " . $conexion->connect_error;
    } else {
        $conexion->autocommit(FALSE); // Deshabilitar el modo autocommit para usar una transacción

        // Comenzar la transacción
        $conexion->begin_transaction();

        // Obtener y mostrar el stock de ambas tiendas
        $stockCENTRAL = obtenerStock($conexion, $cod, 'CENTRAL');
        $stockSUCURSAL = obtenerStock($conexion, $cod, 'SUCURSAL');

        mostrarStock("CENTRAL", $stockCENTRAL);
        mostrarStock("SUCURSAL", $stockSUCURSAL);

        echo "<h2>Actualizar Stock</h2>";
        echo '<form action="stock.php" method="post">
                <input type="hidden" name="stock" value="' . $cod . '">
                <label for="central">CENTRAL:</label>
                <input type="number" name="central" value="' . $stockCENTRAL . '"><br><br>
                <label for="sucursal">SUCURSAL:</label>
                <input type="number" name="sucursal" value="' . $stockSUCURSAL . '"><br><br>
                <input type="submit" value="Actualizar">
              </form>';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $centralNuevo = $_POST['central'];
            $sucursalNuevo = $_POST['sucursal'];
            if (actualizarStock($conexion, $cod, 'CENTRAL', $centralNuevo) && actualizarStock($conexion, $cod, 'SUCURSAL', $sucursalNuevo)) {
                // Confirmar la transacción si no hubo errores
                $conexion->commit();
                echo "<p>Stock actualizado con éxito.</p>";
            } else {
                // Revertir la transacción en caso de error
                $conexion->rollback();
                echo "<p>Error al actualizar el stock.</p>";
            }
        }

        $conexion->autocommit(TRUE); // Volver a habilitar el modo autocommit
        $conexion->close();
    }
} else {
    echo "No se proporcionó un Código de producto válido para ver su stock.";
}

function obtenerStock($conexion, $cod, $tienda) {
    $unidades = -1; // Valor predeterminado para indicar que no está disponible
    $consulta = $conexion->prepare("SELECT unidades FROM stock WHERE producto = ? AND tienda = ?");
    $consulta->bind_param("ss", $cod, $tienda);
    $consulta->execute();
    $consulta->bind_result($unidades);
    $consulta->fetch();
    $consulta->close();
    
    // Verificar si las unidades son diferentes de -1 (el valor predeterminado)
    if ($unidades === -1) {
        $unidades = 0; // Cambiar el valor predeterminado a 0
    }

    return $unidades;
}


function mostrarStock($tienda, $stock) {
    echo "<h2>Tienda $tienda:</h2>";
    echo "<p>Unidades: $stock</p>";
}

function actualizarStock($conexion, $cod, $tienda, $nuevoStock) {
    $consulta = $conexion->prepare("UPDATE stock SET unidades = ? WHERE producto = ? AND tienda = ?");
    $consulta->bind_param("iss", $nuevoStock, $cod, $tienda);
    $resultado = $consulta->execute();
    $consulta->close();
    return $resultado;
}
?>

