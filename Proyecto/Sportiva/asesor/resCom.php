<?php
require_once("../cuentas/asesor.php");
include_once("../componentes/headeradmin.php");
require_once("../connect/connect.php");

if (!isset($_GET['idCom'])) {
    die("Error: ID del comentario no proporcionado.");
}

$idComentario = intval($_GET['idCom']);

if ($con) {
    $consulta = "SELECT c.comCom, u.mailUsu 
                 FROM comentario c
                 JOIN usuario u ON c.usuCom = u.IDusu
                 WHERE c.idCom = $idComentario";
    $resultado = mysqli_query($con, $consulta);
    
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $comentario = $fila['comCom'];
        $emailUsuario = $fila['mailUsu'];
    } else {
        die("Error: Comentario no encontrado.");
    }
} else {
    die("Error: No se pudo conectar a la base de datos.");
}
?>

<div class="container mt-4">
    <h2 class="text-warning">Responder a: <?php echo htmlspecialchars($emailUsuario); ?></h2>
    <p class="text-white"><strong>Comentario:</strong></p>
    <p class="text-white"><?php echo nl2br(htmlspecialchars($comentario)); ?></p>

    <form action="resCom2.php" method="post">
        <input type="hidden" name="id" value="<?php echo $idComentario; ?>">
        <div class="form-group">
            <label for="respuesta" class="text-white">Tu respuesta:</label>
            <textarea id="respuesta" name="respuesta" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

<?php include_once("../componentes/footer.php"); ?>
