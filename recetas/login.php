<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> <!-- Action podría apuntar a la página de procesamiento de inicio de sesión -->
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar sesión</button>
        </form>
        <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
        <br><br>
        <a href="index.php"><img src="assets/img/flecha.png" alt="Volver" id="flecha"></a>
    
        <?php
// Comprobamos si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificamos si se han enviado ambos campos
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        // Recibimos los datos del formulario
        $username = $_POST["username"];
        $contraseña = $_POST["password"];
        
        // Aquí debes realizar la lógica de autenticación, por ejemplo, consultar una base de datos
        // Si el usuario y la contraseña son válidos, redirigir al usuario a la página de inicio
        // De lo contrario, mostrar un mensaje de error
        
        $conexion = new mysqli("localhost", "root", "", "recetasdb");
        
        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }
        
        // Preparar la consulta para buscar el usuario en la base de datos
        $query = "SELECT * FROM usuarios WHERE username='$username' AND contraseña='$contraseña'";
        
        // Ejecutar la consulta
        $resultado = $conexion->query($query);
        // Verificar si se encontró un usuario con las credenciales proporcionadas
        if ($resultado->num_rows == 1) {
            $datos=$resultado->fetch_assoc();
            // Autenticación exitosa
            session_start(); // Iniciar sesión
            $_SESSION["user_data"] = $datos; // Guardar el nombre de usuario en la sesión
            $_SESSION["isAdmin"] = $username == 'admin';
            if ($username=='admin'){
                header("Location: admin.php");
                return;
            }
            header("Location: index.php"); // Redirigir al usuario a la página de inicio
            exit;
        } else {
            // Usuario o contraseña incorrectos
            echo "Usuario o contraseña incorrectos.";
        }
        
        // Cerrar la conexión
        $conexion->close();
    } else {
        // Si faltan campos en el formulario
        echo "Por favor, complete ambos campos de usuario y contraseña.";
    }

        // Por ejemplo, supongamos que tenemos un usuario 'admin' con contraseña '1234'
        if ($username === 'admin' && $contraseña === '1234') {
            // Autenticación exitosa
            // Iniciar sesión, configurar variables de sesión, etc.
            session_start();
            $_SESSION["cod_usuario"] = $username;
            // Redireccionar al usuario a la página de inicio
            header("Location: index.php");
            exit;
        } else {
            // Usuario o contraseña incorrectos
            echo "Usuario o contraseña incorrectos";
        }
    } else {
        // Uno o ambos campos están vacíos
        echo "Por favor, complete todos los campos";
    }
?>
    </div>
</body>
</html>


