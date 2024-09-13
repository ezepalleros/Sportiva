<?php
session_start();
require_once("../connect/connect.php");

if ($con) {
    if (isset($_POST['emailR']) && isset($_POST['conR']) && isset($_POST['nom']) && isset($_POST['ape'])) {
        $email = $_POST['emailR'];
        $conR = $_POST['conR'];
        $nom = $_POST['nom'];
        $ape = $_POST['ape'];

        // Consulta SQL corregida para el INSERT
        $consulta = "INSERT INTO usuario (nomUsu, apeUsu, mailUsu, contraUsu, rolUsu) VALUES ('$nom', '$ape', '$email', MD5('$conR'), 'Usuario')";
        if (mysqli_query($con, $consulta)) {
            header("Location: ../paginas/iniciosesion.php?alta=ok");
            exit();
        } else {
            header("Location: ../paginas/iniciosesion.php?error=sql");
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