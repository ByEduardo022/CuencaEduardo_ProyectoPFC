<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Inicio Sesión</title>
    <style>
        /* Mantén el resto de tu estilo como está */
        .form-container {
            background-color: #f0f8ff; /* Azul claro */
            padding: 20px;
            border-radius: 10px;
            max-width: 500px; /* Ancho máximo del formulario */
            margin: auto; /* Esto centrará el formulario horizontalmente */
            margin-top: 50px; /* Espacio superior */
            margin-bottom: 50px; /* Espacio inferior */
        }
    </style>
</head>

<body>
    <?php
    require_once("header.php");
    ?>
    <br>
    <h4 class="col-12 h3 mb-3 text-center text-danger">Contraseña incorrecta</h4><br>
    <div class="container">
        <form action="comprueba_login.php" method="post" class="form-container p-5 rounded">
            <h1 class="h3 mb-3 text-center">Inicio Sesión</h1>
            <div class="mb-3">
                <label for="user" class="form-label">Usuario</label>
                <input type="text" name="user" class="form-control" id="user" placeholder="Usuario" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" required>
            </div>
            <div class="mb-3 text-center">
                <a href="registrar_usuario.php" class="text-decoration-none">¿No tienes cuenta?</a>
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-lg" type="submit">Iniciar Sesión</button>
            </div>
        </form>
    </div>
</body>

</html>
