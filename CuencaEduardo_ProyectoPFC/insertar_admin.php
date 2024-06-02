<?php

if(isset($_POST["registrar"])) {
    $user = htmlentities(addslashes(trim($_POST["user"])));
    $password = htmlentities(addslashes($_POST["password"]));
    $confirm_password = htmlentities(addslashes($_POST["confirm_password"]));
    $nombre = htmlentities(addslashes(trim($_POST["nombre"])));
    $apellido = htmlentities(addslashes(trim($_POST["apellido"])));
    $email = htmlentities(addslashes(trim($_POST["email"])));

   
    if (strpos($user, ' ') !== false) {
        header("location: sin_espacios_admin.php");
        exit;
    }  


    if ($password !== $confirm_password) {
        header("location: contraseña_distinta_admin.php");

        exit;
    }

    $password_cifrado = password_hash($password, PASSWORD_DEFAULT);

    try {

        require_once 'conexion.php';
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $base->exec("SET CHARACTER SET utf8");

        $sql1 = "SELECT * FROM usuarios WHERE Usuario = :user";

        $resultado = $base->prepare($sql1);

        $resultado->bindValue(":user", $user, PDO::PARAM_STR);

        $resultado->execute();


        if ($resultado->rowCount() == 0) {

            $sql2 = "INSERT INTO usuarios (Usuario, Contraseña, Nombre, Apellido, Email, Admin) VALUES (:user, :password, :nombre, :apellido, :email, 1)";

            $resultado = $base->prepare($sql2);

            $resultado->bindValue(":user", $user, PDO::PARAM_STR);
            $resultado->bindValue(":password", $password_cifrado, PDO::PARAM_STR);
            $resultado->bindValue(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindValue(":apellido", $apellido, PDO::PARAM_STR);
            $resultado->bindValue(":email", $email, PDO::PARAM_STR);

            $resultado->execute();

            $resultado->closeCursor();

            header("location:admin_registrado.php");

        } else {

            header("location:contraseña_distinta_admin.php");

        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
