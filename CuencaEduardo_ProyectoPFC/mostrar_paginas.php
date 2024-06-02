<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: inicio_sesion.php');
    exit();
}

require_once 'conexion.php';

$sql = "SELECT * FROM paginas_usuarios WHERE Usuario = :user ORDER BY fecha ASC";
$resultado = $base->prepare($sql);
$resultado->bindValue(":user", $_SESSION["user"], PDO::PARAM_STR);
$resultado->execute();

$paginas = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mis Páginas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .card {
            border-color: #007bff;
        }
        .btn-warning, .btn-danger {
            margin-left: 10px;
        }
        .card-title {
            color: #007bff;
        }
        
        h1{
            text-align: center;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container mt-5">
        <h1 class="text-primary">Gestion de Administracion de Paginas</h1><br><br>
        <?php
        if (count($paginas) > 0) {
            foreach ($paginas as $pagina) {
                echo "<div class='card mb-3'>";
                echo "<div class='card-body'>";
                echo "<div class='d-flex justify-content-between'>";
                echo "<div>";
                echo "<h2 class='card-title'>" . htmlspecialchars($pagina['Titulo']) . "</h2>";
                echo "<p class='card-text'>" . htmlspecialchars($pagina['Contenido']) . "</p>";
                echo "</div>";
                echo "<div class='d-flex align-items-center'>";
                echo "<a href='modificar_pagina.php?id=" . $pagina['ID'] . "' class='btn btn-warning'><i class='fas fa-edit'></i> Modificar</a>";
                echo "<a href='borrar_pagina.php?id=" . $pagina['ID'] . "' class='btn btn-danger'><i class='fas fa-trash-alt'></i> Eliminar</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-primary'>No tienes publicaciones.</p>";
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
