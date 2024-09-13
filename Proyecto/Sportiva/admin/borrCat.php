<?php
include_once("../componentes/headeradmin.php");
require_once("../connect/connect.php");
require_once("../cuentas/admin.php");

if($con){
    if(isset($_GET['nomCat'])){
        $id = $_GET['nomCat'];

        $eliminarProductos = "DELETE FROM producto WHERE catPro='$id'";
        mysqli_query($con, $eliminarProductos);

        $consulta = "DELETE FROM categoria WHERE IDcat='$id'";
        $resultado = mysqli_query($con, $consulta);

        if($resultado){
            print "<div class='container text-center' style='margin-top: 150px'>";
            print "<h1 class='text-warning'>La categoría fue eliminada</h1>";
            print "<a href='index.php' class='btn btn-warning btn-lg'>Volver</a>";
            print "</div>";   
        } else {
            print "<div class='container text-center' style='margin-top: 150px'>";
            print "<h1 class='text-danger'>Error al eliminar la categoría.</h1>";
            print "<a href='index.php' class='btn btn-warning btn-lg'>Volver</a>";
            print "</div>";
        }
    }
}

require_once("../componentes/footer.php");
?>
