<?php
if (isset($_POST["enviar"])) {
    $user = htmlentities(addslashes(trim($_POST["user"])));
    $password = htmlentities(addslashes($_POST["password"]));
    $confirm_password = htmlentities(addslashes($_POST["confirm_password"]));
    $nombre = htmlentities(addslashes(trim($_POST["nombre"])));
    $apellido = htmlentities(addslashes(trim($_POST["apellido"])));
    $email = htmlentities(addslashes(trim($_POST["email"])));

    // Verificar que el nombre de usuario no contenga espacios
    if (strpos($user, ' ') !== false) {
        header("location: sin_espacios.php");
        exit;
    }

    // Verificar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        header("location: contrasena_distinta.php");
        exit;
    }

    // Cifrar la contraseña
    $password_cifrado = password_hash($password, PASSWORD_DEFAULT);

    try {
        require_once 'conexion.php';
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");

        // Verificar que el nombre de usuario no esté ya registrado
        $sql1 = "SELECT * FROM usuarios WHERE Usuario = :user";
        $resultado = $base->prepare($sql1);
        $resultado->bindValue(":user", $user, PDO::PARAM_STR);
        $resultado->execute();

        if ($resultado->rowCount() == 0) {
            // Insertar el nuevo usuario en la base de datos
            $sql2 = "INSERT INTO usuarios (Usuario, Contraseña, Nombre, Apellido, Email) VALUES (:user, :password, :nombre, :apellido, :email)";
            $resultado = $base->prepare($sql2);
            $resultado->bindValue(":user", $user, PDO::PARAM_STR);
            $resultado->bindValue(":password", $password_cifrado, PDO::PARAM_STR);
            $resultado->bindValue(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindValue(":apellido", $apellido, PDO::PARAM_STR);
            $resultado->bindValue(":email", $email, PDO::PARAM_STR);
            $resultado->execute();
            $resultado->closeCursor();

            // Redirigir al usuario registrado con éxito
            header("location:usuario_registrado.php");
        } else {
            // Redirigir si el usuario ya existe
            header("location:usuario_no_registrado.php");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
