<?php
session_start();
if ($_SESSION['rolUsu'] != 'Admin') {
    header("Location: ../paginascuenta/soloadmin.php");
    exit();
}
?>
