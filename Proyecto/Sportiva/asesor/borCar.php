<?php
require_once("../connect/connect.php");

// Verificar si la conexión a la base de datos fue exitosa
if (!$con) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

if (isset($_GET['idCar'])) {
    $idCarrito = intval($_GET['idCar']);

    // Iniciar la transacción
    mysqli_autocommit($con, FALSE);
    $success = TRUE;

    // Eliminar detalles del carrito
    $consultaDetalles = "DELETE FROM detalle_carrito WHERE carID = $idCarrito";
    $resultadoDetalles = mysqli_query($con, $consultaDetalles);

    if ($resultadoDetalles) {
        // Eliminar el carrito
        $consultaCarrito = "DELETE FROM carrito WHERE IDcar = $idCarrito";
        $resultadoCarrito = mysqli_query($con, $consultaCarrito);

        if (!$resultadoCarrito) {
            $success = FALSE;
        }
    } else {
        $success = FALSE;
    }

    if ($success) {
        mysqli_commit($con);
        header("Location: ../asesor/index.php");
        exit();
    } else {
        mysqli_rollback($con);
        echo "<p class='text-danger'>Error al eliminar la compra.</p>";
    }
} else {
    echo "<p class='text-danger'>ID de carrito no especificado.</p>";
}
?>
