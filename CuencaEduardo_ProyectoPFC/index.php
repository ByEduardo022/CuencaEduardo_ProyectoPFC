<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Explorando el mundo de la programación</title>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .footer-background {
            background-image: url('wave-haikei.png');
            background-size: cover;
            background-position: center;
        }

        .header-background {
            background-image: url('fondo.jpg');
            /* Reemplaza con la ruta a tu imagen */
            background-size: cover;
            background-position: center;
            color: black;
            /* Para asegurarse de que el texto sea legible en fondos oscuros */
        }

        .cookie-banner {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 1);
            color: #fff;
            text-align: center;
            padding: 1em;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cookie-banner p {
            margin: 0;
            flex: 1;
            padding: 0 1em;
        }

        .cookie-banner button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 0.5em 1.5em;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 0.5em;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .cookie-banner button:hover {
            background-color: #45a049;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 1em;
            margin-top: 1em;
        }

        .footer-links a {
            color: #fff;
            text-decoration: none;
        }

        .comments-section {
            position: fixed;
            bottom: 0;
            right: 0;
            width: 500px;
            max-height: 80vh;
            overflow-y: auto;
            background-color: #f8f9fa;
            border-left: 1px solid #ddd;
            border-top: 1px solid #ddd;
            z-index: 1050;
            display: none;
            border-radius: 10px 0 0 10px;
        }

        .comments-section h5 {
            padding: 15px;
            background-color: #f8f9fa;
            margin: 0;
            border-bottom: 1px solid #ddd;
            border-radius: 10px 10px 0 0;
            /* Bordes redondeados en la parte superior */
        }

        .comments-section .comment {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .comments-section .comment strong {
            display: block;
        }

        h5{
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="cookie-banner" id="cookie-banner">
        <p>Utilizamos cookies para asegurarnos de brindarle la mejor experiencia en nuestro sitio web. <br>
            Al continuar utilizando en este sitio, aceptas nuestra <a href="politicaspriv.html"
                class="text-white">Política de Privacidad</a>.</p>
        <button id="accept-cookies">Aceptar</button>
    </div>
    <?php require_once ("header.php"); ?>

    <header class="py-2 border-bottom mb-4 header-background">
        <div class="container">
            <div class="text-center my-5">
                <br>
                <h1 class="fw-bolder">Explorando el Mundo de la Programación</h1><br>
                <p class="lead mb-1">Bienvenidos a nuestro espacio digital donde la tecnología se convierte en la
                    protagonista principal.
                    En este blog, te invitamos a embarcarte en un viaje fascinante a través del vasto y dinámico
                    universo de la informática.
                    Desde los últimos avances en inteligencia artificial hasta los fundamentos de la programación, aquí
                    encontrarás recursos, análisis y
                    consejos para mantenerte al día en un mundo cada vez más digitalizado.</p><br><br>
            </div>
        </div>
    </header>
    <!-- Page content-->

    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-12">
                <?php
                require_once 'conexion.php';

                // Handle comment submission
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment']) && isset($_POST['pagina_id'])) {
                    $pagina_id = $_POST['pagina_id'];
                    $usuario = $_SESSION['user']; // Assuming the user is logged in
                    $comentario = $_POST['comment'];

                    $sql_insert = "INSERT INTO comentarios (pagina_id, usuario, comentario) VALUES (:pagina_id, :usuario, :comentario)";
                    $stmt = $base->prepare($sql_insert);
                    $stmt->bindValue(':pagina_id', $pagina_id, PDO::PARAM_INT);
                    $stmt->bindValue(':usuario', $usuario, PDO::PARAM_STR);
                    $stmt->bindValue(':comentario', $comentario, PDO::PARAM_STR);
                    $stmt->execute();
                }

                $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

                $sql = "SELECT * FROM paginas_usuarios";
                if (!empty($searchTerm)) {
                    $sql .= " WHERE Titulo LIKE :searchTerm ORDER BY fecha ASC";
                } else {
                    $sql .= " ORDER BY fecha ASC";
                }

                $resultado = $base->prepare($sql);

                if (!empty($searchTerm)) {
                    $resultado->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
                }

                $resultado->execute();

                $paginas = $resultado->fetchAll(PDO::FETCH_ASSOC);

                if (isset($_SESSION['user'])) {
                    $sql2 = "SELECT * FROM usuarios WHERE Usuario = :user";

                    $resultado2 = $base->prepare($sql2);

                    $resultado2->bindValue("user", $_SESSION["user"], PDO::PARAM_STR);
                    $resultado2->execute();

                    $usuario = $resultado2->fetchAll(PDO::FETCH_ASSOC);
                }
                ?>
                <!-- Search and create post widgets-->
                <div class="row mb-12">
                    <div class="col-md-8">
                        <!-- Search widget-->
                        <div class="card">
                            <div class="card-header">Búsqueda</div>
                            <div class="card-body">
                                <form method="post" action="">
                                    <div class="input-group">
                                        <input class="form-control" name="searchTerm" type="text"
                                            placeholder="Introduzca el término de búsqueda..."
                                            aria-label="Enter search term ....." aria-describedby="button-search"
                                            value="<?php echo htmlspecialchars($searchTerm); ?>" />
                                        <button class="btn btn-primary" id="button-search" type="submit"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!-- Invite to create post-->
                        <div class="card">
                            <div class="card-header">¿Quieres crear una publicación?</div>
                            <div class="card-body text-center">
                                <p class="mb-4">¡Anímate y comparte tus conocimientos con la comunidad!</p>
                                <a href='crear_pagina.php'><button type='button' class='btn btn-primary'>Crear
                                        Publicacion</button></a>
                                <a href='mostrar_paginas.php'><button type='button' class='btn btn-primary'> Ver Mis
                                        Paginas</button></a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                echo "<br>";
                echo "<br>";

                if (count($paginas) != 0) {
                    $num_paginas = count($paginas);
                    for ($i = 0; $i < $num_paginas; $i++) {
                        if ($i % 2 == 0) {
                            echo "<div class='row'>";
                        }

                        echo "<div class='col-md-8 mb-4'>";
                        echo "<div class='card h-100'>";
                        echo "<div class='card-body'>";
                        echo "<article class='blog-post'>";
                        $pagina = $paginas[$i];
                        echo "<h2 class='card-title text-primary'>" . htmlspecialchars($pagina['Titulo']) . "</h2>";
                        echo "<h6 class='card-subtitle text-dark'>Publicado por " . htmlspecialchars($pagina['Usuario']) . " el día " . htmlspecialchars($pagina['Fecha']) . "</h6>";
                        echo "<br>";
                        echo "<p class='card-text'>" . htmlspecialchars($pagina['Contenido']) . "</p>";

                        // Display comments and action buttons
                        echo "<div class='d-flex justify-content-between align-items-center'>";
                        echo "<div>";
                        echo "<button class='btn btn-primary text-en' onclick='toggleComments(" . htmlspecialchars($pagina['ID']) . ")'><i class='fas fa-comment'></i></button>";
                        echo "<div id='comments-" . htmlspecialchars($pagina['ID']) . "' class='comments-section'>";
                        echo "<h5>Comentarios</h5>";

                        // Comment form
                        if (isset($_SESSION['user'])) {
                            echo "<form method='post' action=''>";
                            echo "<input type='hidden' name='pagina_id' value='" . htmlspecialchars($pagina['ID']) . "' />";
                            echo "<div class='mb-3'>";
                            echo "<br>";
                            echo "<label for='comment' class='form-label'>Agrega un comentario</label>";
                            echo "<br>";
                            echo "<textarea class='form-control' name='comment' id='comment' rows='3' required></textarea>";
                            echo "</div>";
                            echo "<button type='submit' class='btn btn-primary'>Enviar</button>";
                            echo "<hr>";
                            echo "</form>";
                        } else {
                            echo "<p>Inicia sesión para dejar un comentario.</p>";
                        }

                        $sql_comments = "SELECT * FROM comentarios WHERE pagina_id = :pagina_id";
                        $stmt_comments = $base->prepare($sql_comments);
                        $stmt_comments->bindValue(':pagina_id', $pagina['ID'], PDO::PARAM_INT);
                        $stmt_comments->execute();
                        $comments = $stmt_comments->fetchAll(PDO::FETCH_ASSOC);

                        if (count($comments) > 0) {
                            foreach ($comments as $comment) {
                                echo "<div class='comment'><strong>" . htmlspecialchars($comment['usuario']) . ":</strong> " . htmlspecialchars($comment['comentario']) . "<small>(" . htmlspecialchars($comment['fecha']) . ")</small></div>";
                            }
                        } else {
                            echo "<hr>";
                            echo "<p>No hay comentarios aún.</p>";
                        }

                        
                        echo "</div>"; // End comments div
                        echo "</div>"; // End d-flex div for comments
                
                        //Action buttons
                        echo "<div class='ms-auto'>";
                        if (isset($_SESSION["user"])) {
                            echo "<div class='btn-group' role='group' aria-label='Action buttons'>";
                            if ($_SESSION["user"] == $pagina['Usuario']) {
                                echo "<a href='modificar_pagina.php?ID=" . htmlspecialchars($pagina['ID']) . "'><button type='button' class='btn btn-warning me-1'><i class='fas fa-pencil-alt'></i></button></a> ";
                            }
                            if ($_SESSION["user"] == $pagina['Usuario'] || $usuario[0]['Admin'] == '1') {
                                echo "<a href='borrar_pagina.php?ID=" . htmlspecialchars($pagina['ID']) . "'><button type='button' class='btn btn-danger'><i class='fas fa-trash-alt'></i></button></a>";
                            }
                            echo "</div>"; // End btn-group div
                        }
                        echo "</div>"; // End action buttons div
                
                        echo "</div>"; // End d-flex div for comments and action buttons
                        echo "</div>"; // End card-footer div
                        echo "</div>"; // End card div
                        echo "</div>"; // End col-md-8 div
                        if ($i % 2 == 1 || $i == $num_paginas - 1) {
                            echo "</div>"; // End row div
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <footer class="py-5 bg-dark text-white footer-background">
        <div class="container text-center">
            <div class="row">
                <!-- Company Information -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h5 class="text-uppercase mb-4">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope me-2"></i>eduardocuenca2015@gmail.com</li>
                        <li><i class="fas fa-phone"></i>+34 601009110</li>
                    </ul>
                </div>
                <!-- Social Media Links -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h5 class="text-uppercase mb-4">Follow Us</h5>
                    <ul class="list-unstyled d-flex justify-content-center">
                        <li><a href="https://www.facebook.com/?locale=es_ES" class="text-white me-3"><i
                                    class="fab fa-facebook-f fa-lg"></i></a></li>
                        <li><a href="https://x.com/?lang=es" class="text-white me-3"><i
                                    class="fab fa-twitter fa-lg"></i></a></li>
                        <li><a href="https://www.instagram.com/" class="text-white me-3"><i
                                    class="fab fa-instagram fa-lg"></i></a></li>
                        <li><a href="https://www.linkedin.com/in/eduardo-cuenca-a30613173/" class="text-white me-3"><i
                                    class="fab fa-linkedin fa-lg"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="m-0">© Eduardo Cuenca 2º DAM.</p>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script>
        // Function to set a cookie
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                let date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }
        // Function to get a cookie
        function getCookie(name) {
            let nameEQ = name + "=";
            let ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        // Function to erase a cookie
        function eraseCookie(name) {
            document.cookie = name + '=; Max-Age=-99999999;';
        }

        // Check if cookies are accepted
        window.onload = function () {
            if (!getCookie("cookiesAccepted")) {
                document.getElementById("cookie-banner").style.display = "block";
            }
        }

        // Accept cookies
        document.getElementById("accept-cookies").onclick = function () {
            setCookie("cookiesAccepted", "true", 30);
            document.getElementById("cookie-banner").style.display = "none";
        }

        // Toggle comments visibility
        function toggleComments(paginaId) {
            var commentsDiv = document.getElementById('comments-' + paginaId);
            if (commentsDiv.style.display === 'none' || commentsDiv.style.display === '') {
                commentsDiv.style.display = 'block';
            } else {
                commentsDiv.style.display = 'none';
            }
        }
    </script>
</body>

</html>