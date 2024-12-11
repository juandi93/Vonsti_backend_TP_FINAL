<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];


if (!empty($username) && !empty($password)) {
    $_SESSION['usuario'] = $username;
    header("Location: gestion_productos.php");
    exit();
} else {
    header("Location: login.php?error=1");
    exit();
}
?>
