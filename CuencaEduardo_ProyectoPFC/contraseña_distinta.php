<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registrarse</title>
    <style>
        .container {
            background-color: #f0f8ff; /* Light blue */
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        button{
            margin: 10px;
            background-color: #007bff; /* Blue */
            border-color: #007bff; /* Blue */
        }

        button:hover {
            background-color: #0056b3; /* Darker Blue */
            border-color: #0056b3; /* Darker Blue */
        }
    </style>
</head>

<body>

    <?php
    require_once("header.php");
    ?>
    <br>
<h4 class="col-12 h3 mb-3 text-center text-danger">Las contraseñas no coinciden</h4>
<br>
    <div class="container">
        <form action="insertar_usuario.php" method="post">
            <h1 class="col-12 h3 mb-3 text-center">Registrarse</h1>

            <div class="row justify-content-center">
                <div class="col-4 form-floating">
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
                    <label for="nombre">Nombre</label>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-4 form-floating">
                    <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido"
                        required>
                    <label for="apellido">Apellido</label>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-4 form-floating">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Correo electrónico"
                        required>
                    <label for="email">Correo electrónico</label>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-4 form-floating">
                    <input type="text" name="user" class="form-control" id="user" placeholder="Usuario" required>
                    <label for="user">Usuario</label>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-4 form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña"
                        required>
                    <label for="password">Contraseña</label>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-4 form-floating">
                    <input type="password" name="confirm_password" class="form-control" id="confirm_password"
                        placeholder="Confirmar Contraseña" required>
                    <label for="confirm_password">Confirmar Contraseña</label>
                </div>
            </div>
            <br>
            <div class="row justify-content-center text-center">

                <div class="col-4 form-floating">
                    <a href="inicio_sesion.php">¿Ya tienes cuenta?</a>
                </div>

            </div>
            <br>
            <div class="row justify-content-center text-center">
                <button class="col-2 btn btn-lg btn-primary" name="enviar" type="submit">Registrarse </button>
            </div>
        </form>
    </div>

</body>

</html>
