<?php
/**
 * Serviço para resetar a Base de dados
 */
 include_once './DatabaseConnection.php';
 
 DatabaseConnection::resetDB();
 
 header("Location: ../../index.php");
