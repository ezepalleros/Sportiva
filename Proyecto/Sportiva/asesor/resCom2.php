<?php
require_once("../cuentas/asesor.php");
include_once("../componentes/headeradmin.php");
require_once("../connect/connect.php");

if ($con) {
    if (isset($_POST['id']) && isset($_POST['respuesta'])) {
        $idComentario = intval($_POST['id']);
        $respuesta = mysqli_real_escape_string($con, trim($_POST['respuesta']));

        // Verificar longitud de la respuesta
        if (strlen($respuesta) > 200) {
            print "<div class='container text-center' style='margin-top: 150px'>";
            print "<h1 class='text-danger'>La respuesta no puede tener más de 200 caracteres.</h1>";
            print "<a href='index.php' class='btn btn-warning btn-lg'>Volver</a>";
            print "</div>";
        } else {
            // Insertar respuesta y eliminar comentario
            $eliminarComentario = "DELETE FROM comentario WHERE idCom = '$idComentario'";

            $resultadoEliminar = mysqli_query($con, $eliminarComentario);

            if ($resultadoEliminar) {
                print "<div class='container text-center' style='margin-top: 150px'>";
                print "<h1 class='text-success'>Respuesta enviada</h1>";
                print "<a href='index.php' class='btn btn-success btn-lg'>Volver al panel</a>";
                print "</div>";
            } else {
                print "<div class='container text-center' style='margin-top: 150px'>";
                print "<h1 class='text-danger'>Hubo un error al intentar responder.</h1>";
                print "<a href='index.php' class='btn btn-warning btn-lg'>Volver al panel</a>";
                print "</div>";
            }
        }
    } else {
        print "<div class='container text-center' style='margin-top: 150px'>";
        print "<h1 class='text-danger'>Datos no proporcionados.</h1>";
        print "<a href='index.php' class='btn btn-warning btn-lg'>Volver al panel</a>";
        print "</div>";
    }
} else {
    print "<div class='container text-center' style='margin-top: 150px'>";
    print "<h1 class='text-danger'>No se pudo conectar a la base de datos.</h1>";
    print "<a href='index.php' class='btn btn-warning btn-lg'>Volver al panel</a>";
    print "</div>";
}

require_once("../componentes/footer.php");
?>
