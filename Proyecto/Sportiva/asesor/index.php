<?php
require_once("../cuentas/asesor.php");
include_once("../componentes/headeradmin.php");
require_once("../connect/connect.php");
?>

<div class="container text-center">
    <h1 class="text-primary mt-4">Panel de Asesor de Sportiva</h1>
    <p class="lead" style="color: white">Revisión de Comentarios</p>
</div>

<?php
if ($con) {
    // Tipos de comentarios
    $tipos = ['duda', 'queja', 'recomendacion'];

    // Consultar y mostrar comentarios por tipo
    foreach ($tipos as $tipo) {
        // Consulta para obtener comentarios por tipo
        $consulta = "SELECT * FROM comentario WHERE tipCom = '$tipo'";
        $resultado = mysqli_query($con, $consulta);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            echo '<div class="container mt-4">';
            echo "<h2 class='text-primary'>" . ucfirst($tipo) . "</h2>";
            echo '
            <table class="table table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Comentario</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>';
            
            while ($fila = mysqli_fetch_assoc($resultado)) {
                // Obtener el email del usuario
                $usuCom = $fila['usuCom'];
                $consultaUsuario = "SELECT mailUsu FROM usuario WHERE IDusu = $usuCom";
                $resultadoUsuario = mysqli_query($con, $consultaUsuario);
                $emailUsuario = mysqli_fetch_assoc($resultadoUsuario)['mailUsu'];

                // Botón de responder
                $responderUrl = "resCom.php?idCom=" . $fila['idCom'];
                
                echo "
                <tr>
                    <td>{$fila['idCom']}</td>
                    <td>{$fila['comCom']}</td>
                    <td>{$emailUsuario}</td>
                    <td><a href='{$responderUrl}' class='btn btn-warning btn-sm'>Responder</a></td>
                </tr>";
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        }
    }
}
?>

<hr class="custom-separator">

<!-- Sección de Revisión de Compras -->
<div class="container text-center mt-4">
    <h2 class="text-primary">Revisión de Compras</h2>
    
    <?php
    // Consulta para obtener los datos de las compras
    $consultaCompras = "SELECT c.IDcar, c.usuCar, SUM(dc.cantDet * p.prePro) AS totalCompra
                        FROM carrito c
                        JOIN detalle_carrito dc ON c.IDcar = dc.carID
                        JOIN producto p ON dc.proID = p.IDpro
                        GROUP BY c.IDcar, c.usuCar";
    $resultadoCompras = mysqli_query($con, $consultaCompras);

    if ($resultadoCompras && mysqli_num_rows($resultadoCompras) > 0) {
        echo '
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID Carrito</th>
                    <th scope="col">ID Usuario</th>
                    <th scope="col">Total Compra</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>';

        while ($fila = mysqli_fetch_assoc($resultadoCompras)) {
            $idCarrito = $fila['IDcar'];
            $idUsuario = $fila['usuCar'];
            $totalCompra = number_format($fila['totalCompra'], 2);

            echo "
            <tr>
                <td>{$idCarrito}</td>
                <td>{$idUsuario}</td>
                <td>${totalCompra}</td>
                <td>
                    <a href='borCar.php?idCar={$idCarrito}' class='btn btn-success btn-sm' title='Eliminar'>
                        <i class='fa fa-check'></i>
                    </a>
                    <a href='borCar.php?idCar={$idCarrito}' class='btn btn-danger btn-sm' title='Eliminar'>
                        <i class='fa fa-times'></i>
                    </a>
                </td>
            </tr>";
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "<p class='lead'>No hay compras registradas.</p>";
    }
    ?>
</div>

<div class="container mt-4 text-center" style="margin-bottom: 20px;">
    <a href="../paginas/home.php" class="btn btn-secondary mt-4">Volver a la página</a>
</div>

<?php require_once("../componentes/footer.php"); ?>
