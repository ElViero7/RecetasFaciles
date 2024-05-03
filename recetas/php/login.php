<?php
// Comprobamos si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificamos si se han enviado ambos campos
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        // Recibimos los datos del formulario
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // Aquí debes realizar la lógica de autenticación, por ejemplo, consultar una base de datos
        // Si el usuario y la contraseña son válidos, redirigir al usuario a la página de inicio
        // De lo contrario, mostrar un mensaje de error
        
        // Por ejemplo, supongamos que tenemos un usuario 'admin' con contraseña '1234'
        if ($username === 'admin' && $password === '1234') {
            // Autenticación exitosa
            // Iniciar sesión, configurar variables de sesión, etc.
            session_start();
            $_SESSION["username"] = $username;
            // Redireccionar al usuario a la página de inicio
            header("Location: index.html");
            exit;
        } else {
            // Usuario o contraseña incorrectos
            echo "Usuario o contraseña incorrectos";
        }
    } else {
        // Uno o ambos campos están vacíos
        echo "Por favor, complete todos los campos";
    }
}
?>