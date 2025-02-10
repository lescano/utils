<?php

require_once "ci.php";
require_once "fecha.php";
require_once "correo.php";

// Configuración de la conexión
$host = "localhost"; // O la IP del servidor de MySQL
$usuario = "root";   // Usuario de MySQL
$clave = "";         // Contraseña (déjala vacía si no tiene)
$bd = "datos_personas"; // Nombre de la base de datos

$validator = new CiValidator();
$fecha = new FechaNacimiento();
$correos = new Correo();

$personas = [];

// Crear conexión
$conexion = mysqli_connect($host, $usuario, $clave, $bd);

// Verificar conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

for ($i=0; $i < 10; $i++) { 
    $nombre = null;
    $apellido = null;
    $idnombre = null;
    $idapellido = null;
    $ci = null;
    $fnac = null;
    $edad = null;
    $correo = null;

    

    $sql = "SELECT * FROM nombres ORDER BY RAND() LIMIT 1";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado) {
        if (mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            $nombre = $fila["valor"];
            $idnombre = $fila["id"];
        }
    }

    $sql = "SELECT * FROM apellidos ORDER BY RAND() LIMIT 1";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado) {
        if (mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            $apellido = $fila["valor"];
            $idapellido = $fila["id"];
        }
    }

    $ci = $validator->random_ci().PHP_EOL;

    $fnac = $fecha->random_date().PHP_EOL;
    $edad = $fecha->edad($fnac).PHP_EOL;

    $correo = $correos->random_correo($nombre, $apellido, $fnac);

    $personas[] = [
        "idnombre"=>$idnombre,
        "nombre"=>$nombre,
        "idapellido"=>$idapellido,
        "apellido"=>$apellido,
        "ci"=>$ci,
        "fnac"=>$fnac,
        "edad"=>$edad,
        "correos"=>$correo,
    ];

}

// Cerrar conexión
mysqli_close($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Generados</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Datos Generados</h2>

<table>
    <thead>
        <tr>
            <th>ID Nombre</th>
            <th>Nombre</th>
            <th>ID Apellido</th>
            <th>Apellido</th>
            <th>Cédula</th>
            <th>Fecha de Nacimiento</th>
            <th>Edad</th>
            <th>Correos Generados</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($personas as $persona): ?>
            <tr>
                <td><?php echo $persona['idnombre']; ?></td>
                <td><?php echo $persona['nombre']; ?></td>
                <td><?php echo $persona['idapellido']; ?></td>
                <td><?php echo $persona['apellido']; ?></td>
                <td><?php echo $persona['ci']; ?></td>
                <td><?php echo $persona['fnac']; ?></td>
                <td><?php echo $persona['edad']; ?></td>
                <td>
                    <ul>
                        <?php foreach ($persona['correos'] as $correo): ?>
                            <li><?php echo $correo; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
