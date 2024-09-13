<?php
session_start();
include_once("../componentes/header.php");
require_once("../connect/connect.php");

// Inicializar variables para mensajes
$mensaje = '';
$mensajeTipo = ''; // 'success' o 'error'

if ($con) {
    // Verificar si se está enviando un comentario
    if (isset($_POST['tipCom']) && isset($_POST['comCom']) && isset($_SESSION['IDusu'])) {
        $tipCom = $_POST['tipCom'];
        $comCom = $_POST['comCom'];
        $usuCom = $_SESSION['IDusu'];

        // Escapar las entradas para evitar inyecciones SQL
        $tipCom = mysqli_real_escape_string($con, $tipCom);
        $comCom = mysqli_real_escape_string($con, $comCom);

        // Insertar comentario
        $consulta = "INSERT INTO comentario (tipCom, comCom, usuCom) VALUES ('$tipCom', '$comCom', '$usuCom')";
        if (mysqli_query($con, $consulta)) {
            $mensaje = '¡Su comentario ha sido enviado exitosamente!';
            $mensajeTipo = 'success';
        } else {
            $mensaje = 'Ha habido un error al enviar el comentario. Por favor, intente nuevamente.';
            $mensajeTipo = 'error';
        }
    }
}
?>

<div class="container">
    <?php if (isset($_SESSION['IDusu'])): ?>
        <div class="form-section" style="margin-bottom: 40px;">
    <div class="image-container">
        <img src="../img/letra-comentario1.png" alt="Konectar" class="centered-image" style="margin-top: 20px; margin-bottom: 10px;">
    </div>

            <h2 style="color: yellow; text-align: center;">
                <i class="fas fa-pencil-alt"></i> ¡Deja tu comentario!
            </h2>

            <form action="../paginas/comentarios.php" method="post" style="max-width: 600px; margin: 0 auto;">
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="tipCom" style="color: yellow;"><i class="fas fa-tag"></i> Tipo de Comentario:</label>
                    <select class="form-control" id="tipCom" name="tipCom" required>
                        <option value="duda">Duda</option>
                        <option value="queja">Queja</option>
                        <option value="recomendacion">Recomendación</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="comCom" style="color: yellow;"><i class="fas fa-comment"></i> Comentario:</label>
                    <textarea class="form-control" id="comCom" name="comCom" rows="4" required></textarea>
                </div>

                <button type="submit" class="btn btn-warning" style="width: 100%; padding: 10px; font-size: 16px;">
                    <i class="fas fa-paper-plane"></i> Enviar Comentario
                </button>
            </form>
        </div>

        <!-- Espacio de separación -->
        <div style="height: 40px;"></div>

        <?php
        // Mostrar mensaje de éxito o error
        if ($mensaje) {
            echo "<div class='alert alert-" . ($mensajeTipo == 'success' ? 'success' : 'danger') . "' role='alert' style='text-align: center; margin-bottom: 20px;'>
                    " . htmlspecialchars($mensaje) . "
                  </div>";
        }

        // Consultar comentarios solo para Admin y Asesor
        if (isset($_SESSION['rolUsu']) && ($_SESSION['rolUsu'] === 'Admin' || $_SESSION['rolUsu'] === 'Asesor')) {
            $consulta = "SELECT comentario.comCom, comentario.tipCom, comentario.idCom, comentario.usuCom, usuario.nomUsu, usuario.apeUsu 
                         FROM comentario 
                         JOIN usuario ON comentario.usuCom = usuario.IDusu 
                         ORDER BY comentario.idCom DESC";
            $resultado = mysqli_query($con, $consulta);

            if ($resultado) {
                echo "<h2 style='color: yellow; text-align: center; margin-bottom: 20px;'><i class='fas fa-history'></i> Anteriores Comentarios</h2>";
                echo "<div style='background-color: #f1f1f1; border-radius: 12px; padding: 20px; border: 1px solid #ccc; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);'>";
                
                while ($comentario = mysqli_fetch_assoc($resultado)) {
                    echo "<div class='comentario' style='background-color: #fff; border-radius: 10px; padding: 15px; margin-bottom: 20px; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);'>";
                    echo "<p style='margin: 0;'><strong>" . htmlspecialchars($comentario['nomUsu']) . " " . htmlspecialchars($comentario['apeUsu']) . ":</strong> (" . htmlspecialchars($comentario['tipCom']) . ")</p>";
                    echo "<p style='margin: 10px 0;'>" . htmlspecialchars($comentario['comCom']) . "</p>";
                    echo "</div>";
                }
                
                echo "</div>";
            } else {
                echo "<p style='text-align: center;'><i class='fas fa-exclamation-triangle'></i> No hay comentarios disponibles.</p>";
            }
        } else {
            echo "<p style='text-align: center; color: yellow;'><i class='fas fa-exclamation-circle'></i> Solo los administradores y asesores pueden ver los comentarios.</p>";
        }
        ?>
    <?php else: ?>
    <div style="margin-top: 50px; text-align: center; color: white; font-size: 1.5em;">
        <i class='fas fa-user-lock'></i> Debes iniciar sesión para poder dejar un comentario.
        <div class="mt-3">
            <a href="../paginas/iniciosesion.php" class="btn btn-danger btn-lg mt-3">Iniciar sesión</a>
            <a href="../paginas/home.php" class="btn btn-danger btn-lg mt-3">Volver al inicio</a>
        </div>
    </div>
<?php endif; ?>
</div>

<!-- Espacio de separación entre la sección de comentarios y el footer -->
<div style="height: 40px;"></div>

<?php include_once("../componentes/footer.php"); ?>
