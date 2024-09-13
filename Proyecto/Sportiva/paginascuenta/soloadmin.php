<?php
session_start();

if (!isset($_SESSION['rolUsu']) || $_SESSION['rolUsu'] !== 'Admin') {
    include_once("../componentes/header.php");
    ?>
    <div class="container text-center mt-5">
        <h1 style="color: #204C73;">No puedes ingresar a este apartado porque no eres administrador</h1>
        <a href="../paginas/home.php" class="btn btn-primary btn-lg mt-3">Volver a la página principal</a>
    </div>
    <?php
    require_once("../componentes/footer.php");
    exit();
}

include_once("../componentes/header.php");
?>
<div class="container text-center mt-5">
    <h1 style="color: #204C73;">Bienvenido administrador</h1>
    <a href="../admin/index.php" class="btn btn-danger btn-lg mt-3">Ir al panel del administrador</a>
    <a href="../paginas/home.php" class="btn btn-danger btn-lg mt-3">Volver a la página principal</a>
</div>
<?php require_once("../componentes/footer.php"); ?>
