<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();

require_once '../DatabaseConnection/DatabaseConnection.php';

$db = new DatabaseConnection();


$novo = filter_input(INPUT_POST, 'name');
$id = filter_input(INPUT_POST, 'id');

 $db->updateAmbiente($id,$novo);
 
 ?>


