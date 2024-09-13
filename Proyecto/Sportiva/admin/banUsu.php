<?php
require_once("../cuentas/admin.php");
require_once("../connect/connect.php");

if($con){
    if(isset($_GET['IDusu'])){
        $id=$_GET['IDusu'];
    }

    $consulta= "UPDATE usuario SET rolUsu='Ban' WHERE IDusu='$id'";

    mysqli_query($con,$consulta);

    header("Location: indexUsuario.php");
}





?>