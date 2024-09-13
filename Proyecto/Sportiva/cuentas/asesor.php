<?php
session_start();
if ($_SESSION['rolUsu'] != 'Asesor') {
    header("Location: ../paginascuenta/soloasesor.php");
    exit();
}
?>
