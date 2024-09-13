<?php include_once("../componentes/header.php"); ?>
<?php require_once("../connect/connect.php"); ?>

<!-- Formulario de Inicio de Sesión -->

<div class="image-container">
    <img src="../img/letra-inicio1.png" alt="Konectar" class="centered-image" style="margin-top: 20px; margin-bottom: 10px;">
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="../cuentas/login.php" id="ingresar" method="post">
                <div class="form-group">
                    <label for="email" style="color: white;">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="con" style="color: white;">Contraseña</label>
                    <input type="password" class="form-control" id="con" name="con" required>
                </div>
                <button type="submit" id="boton" class="btn btn-warning btn-lg btn-custom" style="margin-top: 30px; margin-bottom: 10px;">Ingresar</button>
            </form>

            <?php
            if (isset($_GET['error'])) {
                print "<strong style='color:red'>Usuario o contraseña incorrectos</strong>";
            }
            ?>
        </div>
    </div>

    <hr class="custom-separator">

<!-- Formulario de Registro -->

    <div class="image-container">
    <img src="../img/letra-inicio2.png" alt="Konectar" class="centered-image" style="margin-top: 20px; margin-bottom: 10px;">
</div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="../cuentas/alta.php" id="registrar" method="post">
                <div class="form-group">
                    <label for="emailR" style="color: white;">Correo Electrónico</label>
                    <input type="email" class="form-control" id="emailR" name="emailR" required>
                </div>
                <div class="form-group">
                    <label for="conR" style="color: white;">Contraseña</label>
                    <input type="password" class="form-control" id="conR" name="conR" required>
                </div>
                <div class="form-group">
                    <label for="nom" style="color: white;">Nombre</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="ape" style="color: white;">Apellido</label>
                    <input type="text" class="form-control" id="ape" name="ape" required>
                </div>
                <button type="submit" class="btn btn-warning btn-lg btn-custom" style="margin-top: 30px; margin-bottom: 10px;">Registrarse</button>
            </form>

            <?php
            if (isset($_GET['alta'])) {
                print "<strong style='color:green'>Ya te puedes loguear</strong>";
            }
            ?>
        </div>
    </div>
</div>

<hr class="custom-separator">

<?php require_once("../componentes/footer.php"); ?>

<script>
    var con = document.getElementById("con");
    var concon = document.getElementById("concon");

    var boton = document.getElementById("boton");

    var ingresar = document.getElementById("ingresar");

    boton.onclick = function () {
        if (con.value !== concon.value) {
            alert("Las contraseñas no coinciden.");
            return false;
        } else {
            form.action = "../cuentas/login.php";
            return true;
        }
    };
</script>
