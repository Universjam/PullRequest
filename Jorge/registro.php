<?php
include("assets/bd/conexion.php");

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Encriptar la contraseña
    $hashed_password = md5($password);

    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO usuario (usuario, nombre, pass) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Usuario registrado con éxito.</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h2>Registro de Usuarios</h2>
<form method="POST">
    <label for="username">Nombre de Usuario:</label><br>
    <input type="text" id="username" name="username" required><br>

    <label for="email">Correo Electrónico:</label><br>
    <input type="text" id="email" name="email" required><br>

    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Registrar">
</form>

</body>
</html>
