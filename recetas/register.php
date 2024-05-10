<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="styles/register.css">
</head>
<body>
    <div class="register-container">
        <h2>Registrarse</h2>
        <form class="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data"> <!-- Action podría apuntar a la página de procesamiento de registro -->
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p> <!-- Podría enlazar a tu página de inicio de sesión -->
        <br><br>
        <a href="index.php"><img src="assets/img/flecha.png" alt="Volver" id="flecha"></a>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $cod_usuario = $_POST["username"];
    $email = $_POST["email"];
    $contraseña = $_POST["password"];

    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "Edf9PlKgJbICA9VE", "recetasdb");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Valor booleano para el campo is_admin
    $admin = false; // Cambia esto según tus necesidades

    // Preparar la consulta SQL
    $query = "INSERT INTO usuarios (cod_usuario, correo_electronico, contraseña, admin) VALUES ('$cod_usuario', '$correo_electronico', '$contraseña', '$admin')";

    // Ejecutar la consulta
    if ($conexion->query($query) === TRUE) {
        echo "¡Registro exitoso!";
    } else {
        echo "Error al registrar el usuario: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>