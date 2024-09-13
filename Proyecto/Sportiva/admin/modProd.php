<?php
include_once("../componentes/headeradmin.php");
require_once("../connect/connect.php");
require_once("../cuentas/admin.php");

if ($con) {
    if (isset($_GET['producto'])) {
        $id = $_GET['producto'];
    }

    $consulta = "SELECT * FROM producto WHERE IDpro='$id'";
    $resultado = mysqli_query($con, $consulta);

    if ($resultado) {
        $filas = mysqli_fetch_array($resultado);
?>

        <form action="modProd2.php" method="post" enctype="multipart/form-data" class="container mt-4" style="margin-bottom: 40px;">
            <div class="mb-3">
                <h2 class="text-white">Código del Producto: <?php print $filas['IDpro']; ?></h2>
                <input type="hidden" name="IDpro" value="<?php print $filas['IDpro']; ?>" />
            </div>
            <div class="mb-3">
                <label for="nomPro" class="form-label text-white">Nombre del producto</label>
                <input value="<?php print $filas['nomPro']; ?>" id="nomPro" type="text" name="nomPro" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="prePro" class="form-label text-white">Precio del producto</label>
                <input value="<?php print $filas['prePro']; ?>" id="prePro" type="number" name="prePro" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="stockPro" class="form-label text-white">Stock del producto</label>
                <input value="<?php print $filas['stockPro']; ?>" id="stockPro" type="number" name="stockPro" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="tallePro" class="form-label text-white">Talle del producto</label>
                <select id="tallePro" name="tallePro" class="form-control" required>
                    <option value="XS" <?php if($filas['tallePro'] == 'XS') echo 'selected'; ?>>XS</option>
                    <option value="S" <?php if($filas['tallePro'] == 'S') echo 'selected'; ?>>S</option>
                    <option value="M" <?php if($filas['tallePro'] == 'M') echo 'selected'; ?>>M</option>
                    <option value="L" <?php if($filas['tallePro'] == 'L') echo 'selected'; ?>>L</option>
                    <option value="XL" <?php if($filas['tallePro'] == 'XL') echo 'selected'; ?>>XL</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label text-white">Imagen actual: <?php print $filas['fotoPro']; ?></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="borrarImagen" name="borrarImagen" value="1">
                    <label class="form-check-label text-white" for="borrarImagen">
                        ¿Desea borrar la imagen?
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <input type="hidden" name="catPro" value="<?php print $filas['catPro']; ?>" />
            </div>
            <button type="submit" class="btn btn-primary">Modificar Producto</button>
        </form>

<?php
    }
}

require_once("../componentes/footer.php");
?>