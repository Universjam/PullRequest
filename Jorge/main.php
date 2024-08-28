<?php
include("assets/bd/conexion.php");

session_start(); // Inicia la sesión

// Verifica si la ID del usuario está presente en la sesión
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Consulta para obtener la tarifa de la tabla "chip" utilizando INNER JOIN con "usuarioId"
    //SELECT * FROM registro INNER JOIN chip on registro.chipId =chip.chipId INNER JOIN usuario on chip.usuarioId=usuario.id WHERE usuario.id=1;
    $sqlTarifa = "SELECT chip.tarifa FROM chip INNER JOIN usuario ON chip.usuarioId = usuario.id WHERE usuario.id = $user_id";
    $resultTarifa = $conn->query($sqlTarifa);

    // Consulta para obtener el consumo de la tabla "registro" utilizando INNER JOIN con "chipId"
    $sqlConsumo = "SELECT registro.consumo FROM registro INNER JOIN chip ON registro.chipId = chip.chipId WHERE chip.usuarioId = $user_id";
    $resultConsumo = $conn->query($sqlConsumo);
} else {
    // Si la ID del usuario no está disponible, mostrar un mensaje de error
    echo "Error: No se proporcionó la ID del usuario.";
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
    <title>Menú de Tarifa y Consumo</title>
    <style>
        .body {
            body {
                font-size: 16px;
                /* Tamaño base del texto para el cuerpo del documento */
            }

            h2 {
                font-size: 24px;
                /* Tamaño del texto para los encabezados h2 */
            }

            h3 {
                font-size: 20px;
                /* Tamaño del texto para los encabezados h3 */
            }

            p {
                font-size: 18px;
                /* Tamaño del texto para los párrafos */
            }
        }
    </style>
</head>

<body>

    <h2>Menú de Tarifa y Consumo</h2>

    <?php
    if (isset($user_id)) {
        echo "<p>ID del Usuario: $user_id</p>";

        // Mostrar la tarifa de la tabla "chip"
        echo "<div>";
        echo "<h3>Tarifa de la tabla 'chip'</h3>";
        if ($resultTarifa->num_rows > 0) {
            while ($row = $resultTarifa->fetch_assoc()) {
                echo "Tarifa: " . $row["tarifa"] . "<br>";
            }
        } else {
            echo "No se encontraron registros en la tabla 'chip' para el usuario con ID $user_id.";
        }
        echo "</div>";

        // Mostrar el consumo de la tabla "registro"
        echo "<div>";
        echo "<h3>Consumo de la tabla 'registro'</h3>";
        if ($resultConsumo->num_rows > 0) {
            while ($row = $resultConsumo->fetch_assoc()) {
                echo "Consumo: " . $row["consumo"] . "<br>";
            }
        } else {
            echo "No se encontraron registros en la tabla 'registro' para el usuario con ID $user_id.";
        }
        echo "</div>";
    }
    ?>

</body>

</html>