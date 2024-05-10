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
        <input type="email" id="email" name="email" required><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="admin">Admin</label>
        <input type="checkbox" id="admin" name="admin" required><br>
        <input type="submit" value="Crear Usuario">
    </form>
    
    <!-- Sección para mostrar los usuarios existentes -->
    <h3>Usuarios existentes</h3>
    <div class="usuarios-container">
        <?php include 'mostrar_usuarios.php'; ?>
    </div>
    
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
        <input type="submit" value="Editar Usuario">
    </form>
    
    <!-- Formulario para eliminar un usuario existente -->
    <h3>Eliminar usuario</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="user_id">ID del Usuario:</label><br>
        <input type="number" id="user_id" name="user_id" required><br>
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
        <input type="submit" value="Crear Receta">
    </form>
    
    <!-- Sección para mostrar las recetas existentes -->
    <h3>Recetas existentes</h3>
    <div class="recetas-container">
        <?php include 'mostrar_recetas.php'; ?>
    </div>
    
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
        <input type="submit" value="Editar Receta">
    </form>
    
    <!-- Formulario para eliminar una receta existente -->
    <h3>Eliminar receta</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- Campo para el ID de la receta a eliminar -->
        <label for="id">ID de la receta:</label><br>
        <input type="number" id="id" name="id" required><br>
        <input type="submit" value="Eliminar Receta">
    </form>

    <a href="index.php"><img src="assets/img/flecha.png" alt="Volver" id="flecha"></a>
</body>
</html>

<?php
// Conexión a la base de datos (reemplaza los valores con los de tu configuración)
$conexion = new mysqli("localhost", "root", "", "recetasdb");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Función para crear un nuevo usuario
function crearUsuario($conexion, $username, $email, $password, $admin) {
    $query = "INSERT INTO usuarios (username, email, password, admin) VALUES ('$username', '$email', '$password', '$admin')";
    return mysqli_query($conexion, $query);
}

// Consulta para mostrar todos los usuarios existentes
function mostrarUsuarios($conexion){
    $query = "SELECT * FROM usuarios";
    return mysqli_query($conexion, $query);
}

// Función para editar un usuario existente
function editarUsuario($conexion, $username, $newUsername, $newEmail, $newPassword, $admin) {
    $query = "UPDATE usuarios SET username='$newUsername', email='$newEmail', password='$newPassword', admin='$admin' WHERE username='$username'";
    return mysqli_query($conexion, $query);
}

// Función para eliminar un usuario existente
function eliminarUsuario($conexion, $username) {
    $query = "DELETE FROM usuarios WHERE username='$username'";
    return mysqli_query($conexion, $query);
}

// Función para crear una nueva receta
function crearReceta($conexion, $nombre, $descripcion, $ingredientes, $tiempo, $categoria, $foto) {
    $query = "INSERT INTO recetas (nombre, descripcion, ingredientes, tiempo, categoria, foto) VALUES ('$nombre', '$descripcion', '$ingredientes', '$tiempo', '$categoria', '$foto')";
    return mysqli_query($conexion, $query);
}

// Función para mostrar las recetas existentes
function mostrarRecetas($conexion){
    $query = "SELECT * FROM recetas";
    return mysqli_query($conexion, $query);
}

// Función para editar una receta existente
function editarReceta($conexion, $id, $newnombre, $newdescripcion, $newingredientes, $newtiempo, $newcategoria, $newfoto) {
    $query = "UPDATE recetas SET nombre='$newnombre', descripcion='$newdescripcion', newingredientes='$newingredientes', newtiempo='$newtiempo', newcategoria='$newcategoria', newfoto='$newfoto' WHERE id='$id'";
    return mysqli_query($conexion, $query);
}

//Función para eliminar una receta existente
function eliminarReceta($conexion, $id) {
    $query = "DELETE FROM recetas WHERE id='$id'";
    return mysqli_query($conexion, $query);
}

// Cierra la conexión a la base de datos al final del archivo
$conexion->close();
?>
