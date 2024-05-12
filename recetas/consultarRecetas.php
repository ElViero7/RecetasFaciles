<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Recetas</title>
    <link rel="stylesheet" href="styles/consultarRecetas.css">
</head>

<body>
    <h1>Recetas Disponibles</h1>
    <a href="index.php"><img src="assets/img/flecha.png" alt="Volver" id="flecha"></a>

    <?php
    // Conexión a la base de datos
    $conexion = new mysqli("127.0.0.1", "root", "", "recetasdb");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Consulta SQL para recuperar las recetas
    $sql = "SELECT * FROM recetas";
    $resultado = $conexion->query($sql);

    // Mostrar las recetas en la página
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo "<div class='receta'>";
            echo "<h2>" . $row["nombre"] . "</h2>";
            echo "<p>" . $row["descripcion"] . "</p>";
            echo "<p>" . $row["ingredientes"] . "</p>";
            echo "<p>" . $row["tiempo"] . "minutos" . "</p>";
            echo "<p>" . $row["categoria"] . "</p>";
            // Mostrar la imagen si la ruta está definida
            if (!empty($row["foto"])) {
                echo "<img src='" . $row["foto"] . "' alt='Imagen de la receta'>";
            } else {
                echo "Imagen no disponible";
            }
            echo "</div>";
        }
    } else {
        echo "No se encontraron recetas.";
    }

    // Cerrar la conexión
    $conexion->close();
    ?>

</body>

</html>