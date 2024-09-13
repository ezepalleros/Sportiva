<?php
include_once("../componentes/headeradmin.php");
require_once("../connect/connect.php");
require_once("../cuentas/admin.php");

if($con){
    if(isset($_GET['alta'])){
        $alta = $_GET['alta'];
    }

    $error = false;
    $errorMessage = "";

    if (strlen($alta) <= 3 || strlen($alta) >= 20) {
        $error = true;
        $errorMessage = "El nombre de la categoría debe contener entre 3 y 20 letras.";
    }

    if (!ctype_alpha($alta)) {
        $error = true;
        $errorMessage = "El nombre de la categoría solo puede contener letras.";
    }

    if ($error) {
        print "
            <div class='container text-center' style='margin-top: 150px'>
                <h1 class='text-danger'>$errorMessage</h1>
                <a href='index.php' class='btn btn-warning btn-lg'>Volver</a>
            </div>";
    } else {
        $consulta = "INSERT INTO categoria (nomCat) VALUES ('$alta')";
        $resultado = mysqli_query($con, $consulta);

        if($resultado){
            print "
                <div class='container text-center' style='margin-top: 150px'>
                    <h1 class='text-warning'>La categoría $alta fue agregada</h1>
                    <a href='index.php' class='btn btn-warning btn-lg'>Volver</a>
                </div>";
        } else {
            print "
                <div class='container text-center' style='margin-top: 150px'>
                    <h1 class='text-danger'>Error al agregar la categoría.</h1>
                    <a href='index.php' class='btn btn-warning btn-lg'>Volver</a>
                </div>";
        }
    }
}

require_once("../componentes/footer.php");
?>
