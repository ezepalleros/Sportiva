<?php
include_once("../componentes/headeradmin.php");
require_once("../connect/connect.php");
require_once("../cuentas/admin.php");

if ($con) {
    if (!empty($_POST['codItem']) && !empty($_POST['nomItem']) && !empty($_POST['precioItem']) && !empty($_POST['stockItem']) && !empty($_POST['talleItem']) && !empty($_POST['categoriaItem']) && isset($_FILES['archivo'])) {

        $codigo = $_POST['codItem'];
        $nombre = $_POST['nomItem'];
        $precio = $_POST['precioItem'];
        $stock = $_POST['stockItem'];
        $talle = $_POST['talleItem'];
        $categoria = $_POST['categoriaItem'];

        $error = false;
        $errorMessage = "";

        if (strlen($nombre) < 3 || strlen($nombre) > 50) {
            $error = true;
            $errorMessage .= "El nombre del producto debe contener entre 3 y 50 caracteres.<br>";
        }

        if (!is_numeric($precio) || $precio <= 0 || $precio > 10000000) {
            $error = true;
            $errorMessage .= "El precio del producto debe ser un número entre 0 y 10,000,000.<br>";
        }

        if (!is_numeric($stock) || $stock <= 0 || $stock > 1000000) {
            $error = true;
            $errorMessage .= "El stock del producto debe ser un número entre 1 y 1,000,000.<br>";
        }

        if ($_FILES['archivo']['error'] === UPLOAD_ERR_NO_FILE) {
            $foto = 'nophoto.jpg';
        } else {
            $hora = time();
            $foto = $hora . '.jpg';
            move_uploaded_file($_FILES['archivo']['tmp_name'], "../img_admin/$foto");
        }

        if ($error) {
            print "<div class='container text-center' style='margin-top: 150px'>";
            print "<h1 class='text-danger'>$errorMessage</h1>";
            print "<a href='index.php' class='btn btn-warning btn-lg'>Volver</a>";
            print "</div>";
        } else {
            $consulta = "INSERT INTO producto (IDpro, nomPro, prePro, stockPro, fotoPro, tallePro, catPro) VALUES ('$codigo', '$nombre', '$precio', '$stock', '$foto', '$talle', '$categoria')";
            $resultado = mysqli_query($con, $consulta);

            if ($resultado) {
                print "<div class='container text-center' style='margin-top: 150px'>";
                print "<h1 class='text-warning'>El Producto $nombre fue agregado</h1>";
                print "<a href='index.php' class='btn btn-warning btn-lg'>Volver</a>";
                print "</div>";
            } else {
                print "<div class='container text-center' style='margin-top: 150px'>";
                print "<h1 class='text-danger'>Error al agregar el producto.</h1>";
                print "<a href='index.php' class='btn btn-warning btn-lg'>Volver</a>";
                print "</div>";
            }
        }
    }
}

require_once("../componentes/footer.php");
?>
