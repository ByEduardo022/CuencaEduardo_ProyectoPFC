<?php
require_once("header.php");

try {
    // Verificar si el formulario ha sido enviado con un nombre de usuario
    if (isset($_POST["user"]) && strlen(trim($_POST["user"])) > 0) {
        require_once 'conexion.php';

        // Preparar la consulta SQL para seleccionar el usuario por nombre de usuario
        $sql = "SELECT * FROM usuarios WHERE Usuario = :user";
        $resultado = $base->prepare($sql);

        // Sanitizar y asignar el nombre de usuario
        $user = htmlspecialchars(trim($_POST["user"]));
        $resultado->bindValue(":user", $user, PDO::PARAM_STR);

        // Ejecutar la consulta
        $resultado->execute();

        // Verificar si se encontró el usuario
        if ($resultado->rowCount() == 1) {
            $registro = $resultado->fetch(PDO::FETCH_ASSOC);

            // Obtener y sanitizar la contraseña proporcionada
            $password = trim($_POST["password"]);

            // Verificar si la contraseña coincide
            if (!password_verify($password, $registro["Contraseña"])) {
                session_start();
                $_SESSION["user"] = $user;
                header("location:index.php");
                exit;
            } else {
                // Redirigir si la contraseña es incorrecta
                header("location:contrasena_incorrecta.php");
                exit;
            }
        } else {
            // Redirigir si no se encontró el usuario
            header("location:usuario_no_encontrado.php");
            exit;
        }
    } 
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
