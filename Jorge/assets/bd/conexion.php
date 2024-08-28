<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "agua";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

//echo "Conexión exitosa a la base de datos";

// Aquí puedes realizar operaciones en la base de datos...

// Cerrar la conexión
//$conn->close();
?>
