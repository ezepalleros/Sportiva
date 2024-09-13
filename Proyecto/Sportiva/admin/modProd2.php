<?php
include_once("../componentes/headeradmin.php");
require_once("../connect/connect.php");
require_once("../cuentas/admin.php");

if($con){
    if( isset($_POST['nomPro']) && isset($_POST['prePro']) && isset($_POST['stockPro']) && isset($_POST['tallePro']) && isset($_POST['catPro']) && isset($_POST['IDpro']) ){
        $codigo = $_POST['IDpro'];
        $nombre = $_POST['nomPro'];
        $precio = $_POST['prePro'];
        $stock = $_POST['stockPro'];
        $talle = $_POST['tallePro'];
        $categoria = $_POST['catPro'];

        $error = false;
        $errorMessage = "";

        if (strlen($nombre) <= 3 || strlen($nombre) >= 50) {
            $error = true;
            $errorMessage .= "El nombre del producto debe contener entre 3 y 50 caracteres.<br>";
        }

        if (!is_numeric($precio) || $precio <= -1 || $precio > 10000000) {
            $error = true;
            $errorMessage .= "El precio del producto debe ser un número entre 0 y 10.000.000.<br>";
        }

        if (!is_numeric($stock) || $stock <= 0 || $stock >= 1000000) {
            $error = true;
            $errorMessage .= "El stock del producto debe ser un número entre 0 y 1.000.000.<br>";
        }

        if (isset($_POST['borrarImagen']) && $_POST['borrarImagen'] == '1') {
            $imagen = 'nophoto.jpg';
        } else {
            $imagen = $_POST['fotoPro'];
        }

        if ($error) {
            print "
            <div class='container text-center' style='margin-top: 125px'>
                <h1 class='text-danger'>$errorMessage</h1>
                <a href='index.php' class='btn btn-warning btn-lg'>Volver</a>
            </div>";
        } else {
            $consulta = "UPDATE producto SET nomPro='$nombre', prePro='$precio', stockPro='$stock', tallePro='$talle', fotoPro='$imagen', catPro='$categoria' WHERE IDpro='$codigo'";
            $resultado = mysqli_query($con, $consulta);

            if ($resultado) {
                print "
                <div class='container text-center' style='margin-top: 125px'>
                    <h1 class='text-warning'>El producto '$nombre' fue modificado</h1>
                    <a href='index.php' class='btn btn-warning btn-lg'>Volver</a>
                </div>";
            } else {
                print "
                <div class='container text-center' style='margin-top: 125px'>
                    <h1 class='text-danger'>Error al modificar el producto.</h1>
                    <a href='index.php' class='btn btn-warning btn-lg'>Volver</a>
                </div>";
            }
        }
    }
}

require_once("../componentes/footer.php");
?>
