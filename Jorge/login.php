<?php
include("assets/bd/conexion.php");

session_start(); // Inicia la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];
    $hashed_password = md5($clave);
    echo $hashed_password;
    

    // Consulta SQL utilizando una consulta preparada
    $sql = "SELECT id FROM usuario WHERE usuario = ? AND pass = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $hashed_password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Inicio de sesión exitoso
        $stmt->bind_result($id);
        $stmt->fetch();

        // Crear una variable de sesión con la id del usuario
        $_SESSION['user_id'] = $id;

        // Redirigir a main.php
        header("Location: main.php");
        exit();
    } else {
        echo "Inicio de sesión fallido. Verifica tus credenciales.";
    }

    // Cerrar la consulta preparada
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <h2>Iniciar Sesión</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required><br>

        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" required><br>

        <button type="submit">Iniciar Sesión</button>
    </form>

</body>
</html>
