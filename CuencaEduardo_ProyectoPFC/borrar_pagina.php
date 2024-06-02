<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Borrar Página</title>
    <style>
        .container {
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            background-color: #98C1FF;
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

        p{
            font-weight: bold;
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

    echo "<div class='form-container'>";
    echo "<form method='post'>";

    echo "<div class='form-group'>";
    echo "<h2 class='fs-1'>Título</h2>";
    echo "<input id='titulo' class='form-control' type='text' value='" . $paginas[0]['Titulo'] . "' disabled/>";
    echo "</div>";
    echo "<br>";
    echo "<br>";
    echo "<div class='form-group'>";
    echo "<h2 class='fs-1'>Contenido</h2>";
    echo "<textarea id='contenido' class='form-control' rows='5' id='comment' disabled>" . $paginas[0]['Contenido'] . "</textarea>";
    echo "</div>";

    echo "<div class='row'>";
    echo "<div class='col text-center'>";
    echo "<br>";
    echo "<br>";
    echo "<p class='col-12 mb-3 text-center text-danger'>¿Seguro que quieres Eliminar la publicación?</p><br>";
    echo "<a href='index.php'><button type='button' class='btn btn-primary'>Volver</button></a> ";
    echo "<input type='submit' value='Eliminar' name='borrar' class='btn btn-danger'></input>";
    echo "</div>";
    echo "</div>";

    echo "</form>";
    echo "</div>";

    echo "</div>";

    if(isset($_POST['borrar'])){

        extract($_POST);
            
        require_once 'conexion.php';
    
        $sql = "DELETE FROM paginas_usuarios WHERE ID = :id";
    
        $resultado = $base->prepare($sql);
    
        $resultado->bindValue(":id", $idpagina, PDO::PARAM_STR);
    
        $resultado->execute();
    
        $paginas = $resultado->fetchAll(PDO::FETCH_ASSOC);
    
        header("location:index.php");
    
        }

    ?>
</body>

</html>
