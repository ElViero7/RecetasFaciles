<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Receta</title>
    <link rel="stylesheet" href="styles/uploadRecipe.css">
</head>

<body>
    <h2>Subir Receta</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" required></textarea><br>
        <label for="ingredientes">Ingredientes:</label><br>
        <input type="ingredientes" id="ingredientes" name="ingredientes" required><br>
        <label for="tiempo">Tiempo:</label><br>
        <input type="number" id="tiempo" name="tiempo" required><br>
        <label for="categoria">Categoría:</label><br>
        <select name="categoria" required>
            <option value="Entrante">Entrante</option>
            <option value="Primero">Primero</option>
            <option value="Segundo">Segundo</option>
            <option value="Postre">Postre</option>
        </select><br><br>
        <label for="foto">Subir foto:</label><br>
        <input type="file" id="foto" name="foto" required><br>
        <!-- Otros campos como ingredientes, instrucciones, etc. -->
        <input type="submit" value="Subir Receta">
    </form>
    <a href="index.php"><img src="assets/img/flecha.png" alt="Volver" id="flecha"></a>

    <?php
    // Verificar si se han enviado los datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se han enviado todos los campos necesarios
        if (isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["ingredientes"]) && isset($_POST["tiempo"]) && isset($_POST["categoria"]) && isset($_FILES["foto"])) {
            // Recibir y limpiar los datos del formulario
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $ingredientes = $_POST["ingredientes"];
            $tiempo = $_POST["tiempo"];
            $categoria = $_POST["categoria"];

            // Conexión a la base de datos (reemplaza los valores con los de tu configuración)
            $conexion = new mysqli("localhost", "root", "", "recetasdb"); // Usuario: root, Contraseña: '', Base de datos: recetasdb

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión a la base de datos: " . $conexion->connect_error);
            }

            // Procesar la imagen subida
            $ruta_destino = "uploads/" . basename($_FILES["foto"]["name"]);
            move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta_destino);

            // Preparar la consulta para insertar la receta en la base de datos
            $query = "INSERT INTO recetas (nombre, descripcion, ingredientes, tiempo, categoria, foto) VALUES ('$nombre', '$descripcion', '$ingredientes', '$tiempo', '$categoria', '$ruta_destino')";

            // Ejecutar la consulta
            if ($conexion->query($query) === TRUE) {
                // Registro de la receta exitoso
                echo "Receta subida correctamente.";
            } else {
                // Si hubo un error al ejecutar la consulta
                echo "Error al subir la receta: " . $conexion->error;
            }

            // Cerrar la conexión
            $conexion->close();
        } else {
            // Si faltan campos en el formulario
            echo "Por favor, complete todos los campos del formulario.";
        }
    }
    ?>

</body>

</html>