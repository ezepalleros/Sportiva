<?php
session_start();
require_once("../connect/connect.php");

if ($con) {
    if (isset($_POST['email']) && isset($_POST['con'])) {
        $email = $_POST['email'];
        $password = $_POST['con'];

        // Consulta SQL corregida
        $consulta = "SELECT * FROM usuario WHERE mailUsu='$email' AND contraUsu=MD5('$password')";
        $resultado = mysqli_query($con, $consulta);
        $fila = mysqli_fetch_array($resultado);

        if ($fila) {
            $_SESSION['IDusu'] = $fila['IDusu'];
            $_SESSION['nomUsu'] = $fila['nomUsu'];
            $_SESSION['apeUsu'] = $fila['apeUsu'];
            $_SESSION['mailUsu'] = $fila['mailUsu'];
            $_SESSION['rolUsu'] = $fila['rolUsu'];

            if ($fila['rolUsu'] == 'Admin') {
                header("Location: ../paginascuenta/soloadmin.php");
                exit();
            } elseif ($fila['rolUsu'] == 'Usuario') {
                header("Location: ../paginascuenta/exitocuenta.php");
                exit();
            } elseif ($fila['rolUsu'] == 'Asesor') {
                header("Location: ../paginascuenta/soloasesor.php");
                exit();
            } elseif ($fila['rolUsu'] == 'Ban') {
                header("Location: ../paginascuenta/baneocuenta.php");
                exit();
            }
        } else {
            header("Location: ../paginas/iniciosesion.php?error=ok");
            exit();
        }
    } else {
        header("Location: ../paginas/iniciosesion.php?error=empty");
        exit();
    }
} else {
    die("Error de conexión: " . mysqli_connect_error());
}


?>
