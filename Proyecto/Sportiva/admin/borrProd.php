<?php
include_once("../componentes/headeradmin.php");
require_once("../connect/connect.php");
require_once("../cuentas/admin.php");

if($con){
    if(isset($_GET['producto'])){

        $id=$_GET['producto'];

    }
    
    $consulta= "DELETE FROM producto WHERE IDpro='$id'"; 

    $resultado= mysqli_query($con,$consulta);

    if($resultado){
        print "
        <div class='container text-center' style='margin-top: 125px'>
            <h1 class='text-danger'>El producto fue eliminado</h1>
            <a href='index.php' class='btn btn-danger btn-lg'>Volver</a>
        </div>";    
       
    }
}

require_once("../componentes/footer.php");
?>