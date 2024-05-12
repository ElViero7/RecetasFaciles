<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="styles/admin.css">
</head>

<body>
    <h2>Panel de Administración</h2>

    <!-- Formulario para crear un nuevo usuario -->
    <h3>Crear nuevo usuario</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Nombre de Usuario:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="email">Correo Electrónico:</label><br>
        <input type="email" id="email" name="correo_electronico" required><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="contraseña" required><br>
        <label for="admin">Admin</label>
        <input type="checkbox" id="admin" name="admin"><br>
        <input type="hidden" name="create_user" value="1">
        <input type="submit" value="Crear Usuario">
    </form>

    <!-- Formulario para editar un usuario existente -->
    <h3>Editar usuario</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="new_username">Nuevo Nombre de Usuario:</label><br>
        <input type="text" id="new_username" name="new_username" required><br>
        <label for="new_email">Nuevo Correo Electrónico:</label><br>
        <input type="email" id="new_email" name="new_email" required><br>
        <label for="new_password">Nueva Contraseña:</label><br>
        <input type="password" id="new_password" name="new_password" required><br>
        <label for="admin">Admin</label>
        <input type="checkbox" id="admin" name="admin" required><br>
        <input type="hidden" name="edit_user" value="1">
        <input type="submit" value="Editar Usuario">
    </form>

    <!-- Formulario para eliminar un usuario existente -->
    <h3>Eliminar usuario</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="user_id">ID del Usuario:</label><br>
        <input type="number" id="user_id" name="cod_usuario" required><br>
        <input type="hidden" name="delete_user" value="1">
        <input type="submit" value="Eliminar Usuario">
    </form>

    <!-- Formulario para crear una nueva receta -->
    <h3>Crear nueva receta</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- Campos para la receta -->
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" required></textarea><br>
        <label for="ingredientes">Ingredientes:</label><br>
        <textarea id="ingredientes" name="ingredientes" required></textarea><br>
        <label for="tiempo">Tiempo:</label><br>
        <input type="number" id="tiempo" name="tiempo" required><br>
        <label for="categoria">Categoría:</label><br>
        <input type="text" id="categoria" name="categoria" required><br>
        <label for="foto">Subir foto:</label><br>
        <input type="file" id="foto" name="foto" required><br>
        <input type="hidden" name="create_recipe" value="1">
        <input type="submit" value="Crear Receta">
    </form>

    <!-- Formulario para editar una receta existente -->
    <h3>Editar receta</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- Campos para editar la receta -->
        <label for="id">ID de la receta:</label><br>
        <input type="number" id="id" name="id" required><br>
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" required></textarea><br>
        <label for="ingredientes">Ingredientes:</label><br>
        <textarea id="ingredientes" name="ingredientes" required></textarea><br>
        <label for="tiempo">Tiempo:</label><br>
        <input type="number" id="tiempo" name="tiempo" required><br>
        <label for="categoria">Categoría:</label><br>
        <input type="text" id="categoria" name="categoria" required><br>
        <label for="foto">Subir foto:</label><br>
        <input type="file" id="foto" name="foto" required><br>
        <input type="hidden" name="edit_recipe" value="1">
        <input type="submit" value="Editar Receta">
    </form>

    <!-- Formulario para eliminar una receta existente -->
    <h3>Eliminar receta</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- Campo para el ID de la receta a eliminar -->
        <label for="id">ID de la receta:</label><br>
        <input type="number" id="id" name="id" required><br>
        <input type="hidden" name="delete_recipe" value="1">
        <input type="submit" value="Eliminar Receta">
    </form>

    <a href="index.php"><img src="assets/img/flecha.png" alt="Volver" id="flecha"></a>
</body>

</html>

<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'recetasdb');

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Procesar el formulario de crear usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $correo_electronico = $_POST['correo_electronico'];
    $contraseña = $_POST['contraseña'];
    $admin = isset($_POST['admin']) ? 1 : 0;

    $sql = "INSERT INTO usuarios (username, correo_electronico, contraseña, admin) VALUES ('$username', '$correo_electronico', '$contraseña', '$admin')";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario creado correctamente.";
    } else {
        echo "Error al crear usuario: " . $conn->error;
    }
}

// Consulta SQL para seleccionar todos los usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar los usuarios en una tabla HTML
    echo "<h3>Usuarios existentes</h3>";
    echo "<table><tr><th>ID</th><th>Nombre de Usuario</th><th>Correo Electrónico</th><th>Admin</th></tr>";
    // Iterar sobre cada fila de resultados
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["cod_usuario"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["correo_electronico"] . "</td>";
        echo "<td>" . ($row["admin"] ? "Sí" : "No") . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // Si no se encontraron usuarios
    echo "No se encontraron usuarios.";
}

// Función para editar un usuario existente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_user'])) {
    $username = $_POST['username'];
    $newUsername = $_POST['new_username'];
    $newEmail = $_POST['new_email'];
    $newPassword = $_POST['new_password'];
    $admin = isset($_POST['admin']) ? 1 : 0;

    $query = "UPDATE usuarios SET username='$newUsername', correo_electronico='$newEmail', contraseña='$newPassword', admin='$admin' WHERE username='$username'";

    if ($conn->query($query) === TRUE) {
        echo "Usuario editado correctamente.";
    } else {
        echo "Error al editar usuario: " . $conn->error;
    }
}

// Función para eliminar un usuario existente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    $username = $_POST['username'];

    $query = "DELETE FROM usuarios WHERE username='$username'";

    if ($conn->query($query) === TRUE) {
        echo "Usuario eliminado correctamente.";
    } else {
        echo "Error al eliminar usuario: " . $conn->error;
    }
}

// Función para crear una nueva receta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_recipe'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $ingredientes = $_POST['ingredientes'];
    $tiempo = $_POST['tiempo'];
    $categoria = $_POST['categoria'];
    // Aquí deberías manejar la subida de la foto, guardando la ruta en la base de datos

    // Ejemplo de cómo podría ser el manejo de la subida de la foto:
    $foto = $_FILES['foto']['name'];
    $ruta = "uploads" . $foto;
    move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);

    // Luego, inserta los datos en la base de datos
    $sql = "INSERT INTO recetas (nombre, descripcion, ingredientes, tiempo, categoria, foto) 
            VALUES ('$nombre', '$descripcion', '$ingredientes', '$tiempo', '$categoria', '$ruta')";

    if ($conn->query($sql) === TRUE) {
        echo "Receta creada correctamente.";
    } else {
        echo "Error al crear la receta: " . $conn->error;
    }
}

// Función para mostrar las recetas existentes
$sql = "SELECT * FROM recetas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Si hay al menos una receta, crea una tabla para mostrarlas
    echo "<h3>Recetas existentes</h3>";
    echo "<table><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Ingredientes</th><th>Tiempo</th><th>Categoría</th><th>Foto</th></tr>";

    // Itera sobre cada fila de resultados y muestra la información de la receta en la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["descripcion"] . "</td>";
        echo "<td>" . $row["ingredientes"] . "</td>";
        echo "<td>" . $row["tiempo"] . "</td>";
        echo "<td>" . $row["categoria"] . "</td>";
        echo "<td><img src='" . $row["foto"] . "' alt='" . $row["nombre"] . "'></td>"; // Muestra la foto de la receta
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron recetas.";
}

// Función para editar una receta existente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_recipe'])) {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $ingredientes = $_POST['ingredientes'];
    $tiempo = $_POST['tiempo'];
    $categoria = $_POST['categoria'];
    $foto = $_POST['foto']; // Esto debería ser manejado adecuadamente, por ejemplo, subiendo la imagen al servidor y guardando su ruta en la base de datos

    // Consulta SQL para actualizar la receta en la base de datos
    $sql = "UPDATE recetas SET nombre='$nombre', descripcion='$descripcion', ingredientes='$ingredientes', tiempo='$tiempo', categoria='$categoria', foto='$foto' WHERE id='$id'";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Receta editada correctamente.";
    } else {
        echo "Error al editar la receta: " . $conn->error;
    }
}

//Función para eliminar una receta existente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_recipe'])) {
    // Obtener el ID de la receta a eliminar
    $id = $_POST['id'];

    // Consulta SQL para eliminar la receta de la base de datos
    $sql = "DELETE FROM recetas WHERE id='$id'";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Receta eliminada correctamente.";
    } else {
        echo "Error al eliminar la receta: " . $conn->error;
    }
}
?>