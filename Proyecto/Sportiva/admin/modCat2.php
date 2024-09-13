<?php
include_once("../componentes/headeradmin.php");
require_once("../connect/connect.php");
require_once("../cuentas/admin.php");

if ($con) {
    if (isset($_GET['mod'])) {
        $mod = $_GET['mod'];
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $error = false;
    $errorMessage = "";

    if (strlen($mod) <= 3 || strlen($mod) >= 20) {
        $error = true;
        $errorMessage = "El nombre de la categoría debe contener entre 3 y 20 letras.";
    }

    if (!ctype_alpha($mod)) {
        $error = true;
        $errorMessage = "El nombre de la categoría solo puede contener letras.";
    }

    if ($error) {
        print "
            <div class='container text-center' style='margin-top: 125px'>
                <h1 class='text-danger'>$errorMessage</h1>
                <a href='index.php' class='btn btn-warning btn-lg'>Volver</a>
            </div>";
    } else {
       $consulta = "UPDATE categoria SET nomCat='$mod' WHERE IDcat='$id'";
        $resultado = mysqli_query($con, $consulta);

        if ($resultado) {
            print "
                <div class='container text-center' style='margin-top: 125px'>
                    <h1 class='text-warning'>La categoría fue modificada a $mod</h1>
                    <a href='index.php' class='btn btn-warning btn-lg'>Volver</a>
                </div>";
        } else {
            print "
                <div class='container text-center' style='margin-top: 125px'>
                    <h1 class='text-danger'>Error al actualizar la categoría.</h1>
                    <a href='index.php' class='btn btn-warning btn-lg'>Volver</a>
                </div>";
        }
    }
}

require_once("../componentes/footer.php");
?>
