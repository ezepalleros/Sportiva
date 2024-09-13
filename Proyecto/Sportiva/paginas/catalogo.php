<?php
session_start();
include_once ("../componentes/header.php");
require_once ("../connect/connect.php");

if (!isset($_SESSION['IDusu'])) {
    echo "
    <div style='margin-top: 50px; text-align: center; color: white; font-size: 1.5em;'>
        <i class='fas fa-user-lock'></i> Debes iniciar sesión para poder ver el catálogo.
        <div class='mt-3'>
            <a href='../paginas/iniciosesion.php' class='btn btn-danger btn-lg mt-3'>Iniciar sesión</a>
            <a href='../paginas/home.php' class='btn btn-danger btn-lg mt-3'>Volver al inicio</a>
        </div>
    </div>";
} else {
    $IDusu = $_SESSION['IDusu'];

    // Inicializar carrito
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Manejar adición al carrito
    if (isset($_POST['add_to_cart'])) {
        $IDpro = $_POST['IDpro'];
        $nomPro = $_POST['nomPro'];
        $prePro = $_POST['prePro'];
        $tallePro = $_POST['tallePro'];
        $cantidad = 1;

        // Agregar producto al carrito
        $_SESSION['carrito'][] = [
            'IDpro' => $IDpro,
            'nomPro' => $nomPro,
            'prePro' => $prePro,
            'tallePro' => $tallePro,
            'cantPro' => $cantidad
        ];
    }

    // Mostrar catálogo de productos
    if ($con) {
        $consultaCategorias = "SELECT IDcat, nomCat FROM categoria";
        $resultadoCategorias = mysqli_query($con, $consultaCategorias);

        echo '
        <div class="image-container" style="margin-bottom: 30px;">
            <img src="../img/letra-catalogo1.png" alt="catalogo" class="centered-image" style="margin-top: 50px; margin-bottom: 30px;">
        </div>';

        while ($filasCategorias = mysqli_fetch_array($resultadoCategorias)) {
            echo "<hr class='custom-separator'>";

            // Título de la categoría
            echo "<h2 style='color: yellow; font-size: 100px; text-align: center; font-family: Arial, sans-serif; text-shadow: 2px 2px 4px #FFFFFF;'>$filasCategorias[nomCat]</h2>";

            $idCategoriaActual = $filasCategorias['IDcat'];

            $consultaProductos = "SELECT * FROM producto WHERE catPro = $idCategoriaActual";
            $resultadoProductos = mysqli_query($con, $consultaProductos);

            echo "<div id='carousel-$idCategoriaActual' class='carousel slide' data-bs-ride='carousel'>
                <div class='carousel-inner'>";

            $productos = [];
            while ($filasProductos = mysqli_fetch_array($resultadoProductos)) {
                $productos[] = $filasProductos;
            }

            for ($i = 0; $i < ceil(count($productos) / 3); $i++) {
                $activeClass = ($i === 0) ? 'active' : '';
                echo "<div class='carousel-item $activeClass'>
                    <div class='container'>
                        <div class='row'>";

                for ($j = 0; $j < 3; $j++) {
                    $index = $i * 3 + $j;
                    if (isset($productos[$index])) {
                        $producto = $productos[$index];
                        echo "
                        <div class='col-md-4'>
                            <div class='card mb-3 bg-dark text-white' style='margin: auto;'>
                                <img src='../img_admin/{$producto['fotoPro']}' class='img-fluid rounded-start border border-dark' alt='Producto'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$producto['nomPro']}</h5>
                                    <p class='card-text'>Precio: {$producto['prePro']}</p>
                                    <p class='card-text'>Talle: {$producto['tallePro']}</p>
                                    <form method='post'>
                                        <input type='hidden' name='IDpro' value='{$producto['IDpro']}'>
                                        <input type='hidden' name='nomPro' value='{$producto['nomPro']}'>
                                        <input type='hidden' name='prePro' value='{$producto['prePro']}'>
                                        <input type='hidden' name='tallePro' value='{$producto['tallePro']}'>
                                        <button type='submit' name='add_to_cart' class='btn btn-primary btn-sm'><i class='bi bi-cart'></i> Añadir al carrito</button>
                                    </form>
                                </div>
                            </div>
                        </div>";
                    }
                }

                echo "</div>
                    </div>
                </div>";
            }

            echo "</div>
                <button class='carousel-control-prev' type='button' data-bs-target='#carousel-$idCategoriaActual' data-bs-slide='prev'>
                    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                    <span class='visually-hidden'>Anterior</span>
                </button>
                <button class='carousel-control-next' type='button' data-bs-target='#carousel-$idCategoriaActual' data-bs-slide='next'>
                    <span class='carousel-control-next-icon' aria-hidden='true'></span>
                    <span class='visually-hidden'>Siguiente</span>
                </button>
            </div>
            <div style='margin-bottom: 50px;'></div>";
        }

        echo "</div>";
    }

    // Botón del carrito de compras
    echo "
    <div style='position: fixed; bottom: 20px; right: 20px; z-index: 1000;'>
        <a href='../paginas/compra.php'>
            <img src='../img/boton-compra.png' alt='Carrito de compras' style='width: 80px;'>
        </a>
    </div>";
}

require_once ("../componentes/footer.php");
?>
