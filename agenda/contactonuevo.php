<?php

$errores = [];
$nombre = '';
$apellido1 = '';
$apellido2 = '';
$telefono = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido1 = isset($_POST['apellido1']) ? $_POST['apellido1'] : '';
    $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : '';
    $telefono = $_POST['telefono'];

    if (empty($nombre) || empty($apellido1) || empty($apellido2) || empty($telefono)) {
        $errores[] = "Todos los campos son obligatorios.";
    } else {
        if (empty($nombre)) {
            $errores[] = "Por favor ingrese su nombre.";
        } else {
            if (!preg_match("/^[a-zA-Z ]*$/", $nombre)) {
                $errores[] = "Sólo se permiten letras y espacios en blanco en el nombre.";
            }
        }

        if (empty($apellido1)) {
            $errores[] = "Por favor ingrese su primer apellido.";
        } else {
            if (!preg_match("/^[a-zA-Z ]*$/", $apellido1)) {
                $errores[] = "Sólo se permiten letras y espacios en blanco en el primer apellido.";
            }
        }

        if (empty($apellido2)) {
            $errores[] = "Por favor ingrese su segundo apellido.";
        } else {
            if (!preg_match("/^[a-zA-Z ]*$/", $apellido2)) {
                $errores[] = "Sólo se permiten letras y espacios en blanco en el segundo apellido.";
            }

            if (empty($telefono)) {
                $errores[] = "Por favor ingrese su número de teléfono.";
            }

            if (empty($errores)) {
                // Llamar a la función introducirDatos
                introducirDatos($nombre, $apellido1, $apellido2, $telefono);
            }
        }
    }
}


  function introducirDatos($nombre, $apellido1, $apellido2, $telefono) {
      $conexion = new mysqli('localhost', 'agenda', 'agenda', 'agenda');
      if ($conexion->connect_error) {
          echo "Error de conexión: " . $conexion->connect_error;
      } else {
          $consulta = $conexion->prepare("INSERT INTO contactos (nombre, apellido1, apellido2, telefono) VALUES (?,?,?,?)");
          $consulta->bind_param("ssss", $nombre, $apellido1, $apellido2, $telefono);

          if ($consulta->execute()) {
              echo "Contacto insertado correctamente";
          } else {
              echo "Error, no se ha podido agregar el contacto correctamente" . $conexion->error;
          }

          $consulta->close();
          $conexion->close();
      }
  }

  echo (
    '<form name="input" action="contactonuevo.php " method="post">
        Nombre : <input type="text" name="nombre" id="nombre" value="' . $nombre . '" required><br>
        Apellido1 : <input type="text" name="apellido1" id="apellido1" value="' . $apellido1 . '" required><br>
        Apellido2 : <input type="text" name="apellido2" id="apellido2" value="' . $apellido2 . '" required><br>
        Teléfono : <input type="text" name="telefono" id="telefono" value="' . $telefono . '" required><br><br>
        <input type="submit" value="Enviar Formulario">
    </form>'
  );

  verContactos();
  function verContactos() {
      $conexion = new mysqli('localhost', 'agenda', 'agenda', 'agenda');
      if ($conexion->connect_error) {
          echo "Error de conexión: " . $conexion->connect_error;
      } else {
          $resultado = $conexion->query("SELECT idContacto, nombre, apellido1, apellido2, telefono FROM contactos;");
          if (!$resultado) {
              echo "Error al realizar la sentencia SQL";
          } else {
              if ($resultado->num_rows == 0) {
                  echo("<p>No existe ningún contacto almacenado en la base de datos</p>");
              } else {
                    if($resultado->fetch_array()){
                  echo ('
                      <style>
                        table {
                          border-collapse: collapse;
                          width: 70%;
                          margin: 20px auto;
                        }
                        
                        th, td {
                          text-align: center;
                          padding: 5px;
                        }
                        
                        tr:nth-child(even) {
                          background-color: #f2f2f2;
                          width: 80%;
                        }
                        
                        th {
                          background-color: #04AA6D;
                          color: white;
                          width: 270px;
                        }
                      </style>
                      <table>
                          <tr>
                              <th>IdContacto</th>
                              <th>Nombre</th>
                              <th>Apellido 1</th>
                              <th>Apellido 2</th>
                              <th>Teléfono</th>
                          </tr>'
                      
                      );

                      while ($fila = $resultado->fetch_assoc()) {
                        $idContacto = $fila['idContacto'];
                        echo ('
                            <tr>
                                <td>' . $fila['idContacto'] . '</td>
                                <td>' . $fila['nombre'] . '</td>
                                <td>' . $fila['apellido1'] . '</td>
                                <td>' . $fila['apellido2'] . '</td>
                                <td>' . $fila['telefono'] . '</td>
                                <td>
                                  <a class="delete-link" href="borrarcontacto.php? id=' . $idContacto . '">
                                    <img src="papelera.png" alt="Eliminar" width="30" height="30">
                                  </a>
                                </td>
                            </tr>'
                        );
                    }
    
                    echo '</table>';
                  }
              }
          }
      }
  }

?>
