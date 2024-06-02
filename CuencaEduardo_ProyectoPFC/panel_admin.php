
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Panel de Administrador</title>
    <style>
        body {
            background-color: #e9f0f5; 
        }
        .container {
            background-color: #DDFFBA;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container col-md-4 text-center">
        <h1 class="h3 mb-3 text-center">Panel de Administrador</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </form>
    </div>
<br><br>
</body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["password"] == "Administrador1") {
        header("Location: formulario_admin.php");
        exit; 
    } else {
        echo " ";
        echo "<h1 class='col-12 h3 mb-3 text-center text-danger'>Contraseña Incorrecta</h1>";
    }
}
?>
</html>
