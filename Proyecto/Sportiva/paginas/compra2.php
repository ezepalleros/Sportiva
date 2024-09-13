<?php
include_once("../componentes/header.php");
require_once("../connect/connect.php");

if (!isset($_SESSION['IDusu'])) {
    header("Location: ../paginas/iniciosesion.php");
    exit();
}

$IDusu = $_SESSION['IDusu'];

if (empty($_SESSION['carrito'])) {
    echo "<div class='container text-center' style='margin-top: 125px'>
        <h1 class='text-danger'>No hay productos en el carrito</h1>
        <a href='../paginas/catalogo.php' class='btn btn-danger btn-lg'>Volver al catálogo</a>
    </div>";
    require_once("../componentes/footer.php");
    exit();
}

// Verificar si la conexión a la base de datos fue exitosa
if (!$con) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Comenzar la transacción
mysqli_autocommit($con, FALSE);
$success = TRUE;

// Insertar datos en la tabla carrito (una vez por transacción)
$consultaCarrito = "INSERT INTO carrito (usuCar, fechaCar) VALUES ($IDusu, NOW())";
$resultadoCarrito = mysqli_query($con, $consultaCarrito);

if ($resultadoCarrito) {
    $IDcar = mysqli_insert_id($con); // Obtener el ID del carrito recién insertado

    // Iterar sobre los productos en el carrito
    foreach ($_SESSION['carrito'] as $index => $producto) {
        $idProducto = $producto['IDpro'];
        $cantidad = 1; // Solo se puede agregar uno individualmente

        // Verificar stock del producto
        $consultaStock = "SELECT stockPro FROM producto WHERE IDpro = $idProducto";
        $resultadoStock = mysqli_query($con, $consultaStock);

        if ($resultadoStock) {
            $fila = mysqli_fetch_assoc($resultadoStock);
            $stockDisponible = $fila['stockPro'];

            if ($stockDisponible >= $cantidad) {
                // Restar stock del producto
                $nuevoStock = $stockDisponible - $cantidad;
                $consultaActualizarStock = "UPDATE producto SET stockPro = $nuevoStock WHERE IDpro = $idProducto";
                $resultadoActualizarStock = mysqli_query($con, $consultaActualizarStock);

                if ($resultadoActualizarStock) {
                    // Insertar detalles del carrito
                    $consultaDetalle = "INSERT INTO detalle_carrito (carID, proID, cantDet, preDet) 
                                        VALUES ($IDcar, $idProducto, $cantidad, 
                                                (SELECT prePro FROM producto WHERE IDpro = $idProducto))";
                    $resultadoDetalle = mysqli_query($con, $consultaDetalle);

                    if (!$resultadoDetalle) {
                        $success = FALSE;
                        break;
                    }
                } else {
                    $success = FALSE;
                    break;
                }
            } else {
                $success = FALSE;
                break;
            }
        } else {
            $success = FALSE;
            break;
        }
    }
} else {
    $success = FALSE;
}

if ($success) {
    mysqli_commit($con);
    echo "
    <div class='container text-center' style='margin-top: 125px'>
        <h1 class='text-success'>Compra realizada con éxito</h1>
        <a href='../paginas/home.php' class='btn btn-success btn-lg'>Volver al inicio</a>
    </div>";
    // Limpiar el carrito
    unset($_SESSION['carrito']);
} else {
    mysqli_rollback($con);
    echo "
    <div class='container text-center' style='margin-top: 125px'>
        <h1 class='text-danger'>Error al intentar realizar una compra</h1>
        <a href='../paginas/home.php' class='btn btn-danger btn-lg'>Volver al inicio</a>
    </div>";
}

require_once("../componentes/footer.php");
?>