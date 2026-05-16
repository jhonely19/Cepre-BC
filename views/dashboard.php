<?php

session_start();

if(!isset($_SESSION["login"])){

    header("Location:index.php?ruta=login");

}
?>

<h1>
    Bienvenido al Dashboard CEPRE BC
</h1>

<a href="logout.php">
    Cerrar Sesión
</a>