<style>
    body {
        background-color: #f0f8ff;
    }
</style>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between header-black">
        <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <img src="volver.png" width="100px" height="100px">
        </a>
        <div class="col-md-3 text-end">
            <?php
            if (!isset($_SESSION["user"])) {
                echo "<a href='inicio_sesion.php'><button type='button' class='btn btn-primary'>Iniciar Sesión </button></a>";
                echo " ";
                echo "<a href='registrar_usuario.php'><button type='button' class='btn btn-primary'> Registrarse</button></a>";
            } else {
                echo "<a href='cerrar_sesion.php'><button type='button' class='btn btn-primary'>Cerrar Sesión</button></a>";
            }
            ?>
        </div>
    </header>
</div>
