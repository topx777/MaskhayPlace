<?php
session_start();

if($_SESSION["admin"]) {
    unset($_SESSION["admin"]);
}

header('Location: ../login_admin.php');
?>