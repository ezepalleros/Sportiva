<?php
session_start();
include_once("../componentes/header.php");
require_once("../connect/connect.php");

if (!isset($_SESSION['IDusu'])) {
    echo "
    <div style='margin-top: 50px; text-align: center; color: white; font-size: 1.5em;'>
        <i class='fas fa-user-lock'></i> Debes iniciar sesión para poder ver el carrito de compras.
        <div class='mt-3'>
            <a href='../paginas/iniciosesion.php' class='btn btn-danger btn-lg mt-3'>Iniciar sesión</a>
            <a href='../paginas/home.php' class='btn btn-danger btn-lg mt-3'>Volver al inicio</a>
        </div>
    </div>";
    require_once("../componentes/footer.php");
    exit();
}

$IDusu = $_SESSION['IDusu'];

// Verificar si se ha solicitado eliminar un producto
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['index'])) {
    $index = intval($_GET['index']);
    if (isset($_SESSION['carrito'][$index])) {
        unset($_SESSION['carrito'][$index]);
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
}

if (empty($_SESSION['carrito'])) {
    echo "<div style='margin-top: 50px; text-align: center; color: white; font-size: 1.5em;'>
        <p>No tienes productos en el carrito.</p>
        <a href='../paginas/catalogo.php' class='btn btn-danger btn-lg mt-3'>Volver al catálogo</a>
    </div>";
} else {
    $totalCompra = 0;

    echo "<div class='container' style='margin-top: 50px;'>
        <h2 style='color: yellow; text-align: center;'>Tu Carrito de Compras</h2>
        <table class='table table-dark table-striped'>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>";

    foreach ($_SESSION['carrito'] as $index => $producto) {
        $nomPro = isset($producto['nomPro']) ? $producto['nomPro'] : 'Desconocido';
        $prePro = isset($producto['prePro']) ? $producto['prePro'] : 0;
        $tallePro = isset($producto['tallePro']) ? $producto['tallePro'] : 'Desconocido';
        
        $productoTotal = $prePro;
        $totalCompra += $productoTotal;

        echo "<tr>
            <td>{$nomPro} (Talle: {$tallePro})</td>
            <td>{$prePro}</td>
            <td><a href='?action=remove&index={$index}' class='btn btn-danger btn-sm'>Eliminar</a></td>
        </tr>";
    }

    echo "</tbody>
        </table>
        <h3 style='color: yellow; text-align: center;'>Total: $$totalCompra</h3>
        <div style='text-align: center; margin-top: 20px;'>
            <a href='compra2.php' class='btn btn-success btn-lg'>Comprar</a>
        </div>
    </div>";
}

require_once("../componentes/footer.php");
?>
