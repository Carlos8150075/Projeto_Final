<?php


include_once './assets/DatabaseConnection/DatabaseConnection.php';

//DatabaseConnection::deleteDB();

session_start();
session_destroy();
session_abort();

header("location: PaginaInicial.php");
exit();
?>
