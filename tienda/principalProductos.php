<?php

verProductos(); // Llamamos a la función verProductos

function verProductos() {
    $conexion = new mysqli('localhost', 'dwes', 'dwes', 'dwes');
    
    if ($conexion->connect_error) {
        echo "Error de conexión: " . $conexion->connect_error;
    } else {
        $resultado = $conexion->query("SELECT cod, nombre_corto, descripcion, PVP, familia FROM producto");
        
        if (!$resultado) {
            echo "Error al realizar la sentencia SQL";
        } else {
            if ($resultado->num_rows == 0) {
                echo "<p>No existe ningún producto almacenado en la base de datos</p>";
            } else {
                // Inicia la tabla
                echo '
                <style>
                    table {
                        border-collapse: collapse;
                        width: 100%;
                        margin: 20px auto;
                    }
                    th, td {
                        text-align: center;
                        padding: 5px;
                    }
                    tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }
                    th {
                        background-color: #04AA6D;
                        color: white;
                    }
                </style>
                <table>
                    <tr>
                        <th>cod</th>
                        <th>nombre_corto</th>
                        <th>descripcion</th>
                        <th>PVP</th>
                        <th>familia</th>
                    </tr>';
                
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<tr>
                            <td> <a class="ver-stock" href="stock.php?stock=' . $fila['cod'] . '">' . $fila['cod'] . '</a></td>
                            <td>' . $fila['nombre_corto'] . '</td>
                            <td>' . $fila['descripcion'] . '</td>
                            <td>' . $fila['PVP'] . '</td>
                            <td>' . $fila['familia'] . '</td>
                          </tr>';
                }
                
                echo '</table>'; // Cierra la tabla
            }
        }
    }
}
