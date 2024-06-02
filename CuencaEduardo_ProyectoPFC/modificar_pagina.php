<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modificar Página</title>
    <style>
        .container {
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            background-color: #98C1FF; /* Light Green */
        }

        .form-control {
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #007bff; /* Blue */
            border-color: #007bff; /* Blue */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker Blue */
            border-color: #0056b3; /* Darker Blue */
        }

        .btn-warning {
            background-color: #ffc107; /* Yellow */
            border-color: #ffc107; /* Yellow */
        }

        .btn-warning:hover {
            background-color: #d39e00; /* Darker Yellow */
            border-color: #d39e00; /* Darker Yellow */
        }
        h2{
            color: darkblue;
        }

    </style>
</head>

<body>
    <?php
    require_once("header.php");
    require_once("comprobar_sesion.php");

    $idpagina = $_GET['ID'];

    echo "<div class='container'>";

    require_once 'conexion.php';

    $sql = "SELECT * FROM paginas_usuarios WHERE ID = :id";

    $resultado = $base->prepare($sql);

    $resultado->bindValue(":id", $idpagina, PDO::PARAM_STR);

    $resultado->execute();

    $paginas = $resultado->fetchAll(PDO::FETCH_ASSOC);

    echo "<form method='post'>";
    echo "<br>";
    echo "<h2 class='fs-1'>Título</h2>";
    echo "<input class='form-control' name='titulo' type='text' value='" . $paginas[0]['Titulo'] . "' />";
    echo "<br>";
    echo "<br>";
    echo "<h2 class='fs-1'>Contenido</h2>";
    echo "<div class='col-xs-4'>";
    echo "<textarea name='contenido' class='form-control' rows='5' id='comment'>" . $paginas[0]['Contenido'] . "</textarea>";
    echo "</div>";

    echo "<div class='row'>";
    echo "<div class='col text-center'>";
    echo "<br>";
    echo "<a href='index.php'><button type='button' class='btn btn-primary'>Volver</button></a> ";
    echo "<input type='submit' value='Modificar' name='modificar' class='btn btn-warning'></input>";
    echo "</div>";
    echo "</div>";

    echo "</form>";

    echo "</div>";

    if(isset($_POST['modificar'])){

    extract($_POST);
        
    require_once 'conexion.php';

    $sql = "UPDATE paginas_usuarios SET Titulo = :titulo, Contenido = :contenido, Fecha = :fecha WHERE ID = :id";

    $resultado = $base->prepare($sql);

    $resultado->bindValue(":titulo", $titulo, PDO::PARAM_STR);

    $resultado->bindValue(":contenido", $contenido, PDO::PARAM_STR);

    $resultado->bindValue(":id", $idpagina, PDO::PARAM_STR);

    $fechaactual = getdate();

    $fecha = $fechaactual['year'] . '-' . $fechaactual['mon'] . '-' . $fechaactual['mday'] . '-';

    $resultado->bindValue(":fecha", $fecha, PDO::PARAM_STR);

    $resultado->execute();

    $paginas = $resultado->fetchAll(PDO::FETCH_ASSOC);

    echo "<br>";
    echo "<br>";
    echo "<br>";

    header("Refresh:0");

    }

    ?>
</body>

</html>
