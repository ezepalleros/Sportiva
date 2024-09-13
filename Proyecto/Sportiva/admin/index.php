<?php
include_once("../componentes/headeradmin.php");
require_once("../connect/connect.php");
require_once("../cuentas/admin.php");
?>

<div class="container text-center">
    <h1 class="text-primary mt-4">Panel de administrador de Sportiva</h1>
    <p class="lead" style="color: white">Altas, Bajas y Modificaciones</p>
</div>

<?php
if ($con) {
    print '<div class="container">';
    
    $consulta = "SELECT IDcat, nomCat FROM categoria";
    $resultado = mysqli_query($con, $consulta);

    if ($resultado) {
        print '
    <table class="table table-bordered mt-4 text-center">
        <caption> </caption>
        <thead class="thead-dark">
            <tr>
                <th scope="col">Categoria</th>
                <th scope="col">Ver Productos</th>
                <th scope="col">Modificar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>';

while ($filas = mysqli_fetch_array($resultado)) {
    print "
        <tr>
            <td>{$filas['nomCat']}</td>
            <td><a href='producto.php?nomCat={$filas['IDcat']}' class='btn btn-info btn-sm'>Ver Productos</a></td>
            <td><a href='modCat.php?nomCat={$filas['IDcat']}' class='btn btn-warning btn-sm'>Modificar</a></td>
            <td><a href='borrCat.php?nomCat={$filas['IDcat']}' class='btn btn-danger btn-sm'>Eliminar</a></td>
        </tr>";
}

print '</tbody>';
print '</table>';
    }

    print '</div>';
}
?>

<div class="container text-center" style="margin-bottom: 20px;">
<h1 class="text-primary mt-4">Agregar una nueva categoría</h1>
<div class="container mt-4">
    <form action="altaCat.php" method="get" class="form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <label for="alta" class="sr-only"> </label>
            <input id="alta" name="alta" type="text" class="form-control" placeholder="Nueva Categoria" required>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Agregar categoria</button>
    </form>
</div>
</div>

<div class="container mt-4 text-center" style="margin-bottom: 40px;">
<h1 class="text-primary mt-4">Ir al panel de usuarios</h1>
    <a href="indexUsuario.php" class="btn btn-success mt-4">Panel de Usuarios</a>
</div>


<div class="container mt-4 text-center" style="margin-bottom: 40px;">
<a href="../paginas/home.php" class="btn btn-secondary mt-4">Volver a la página</a>
</div>

<?php require_once("../componentes/footer.php"); ?>
