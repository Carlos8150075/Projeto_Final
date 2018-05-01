<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//session_start();

require_once '../DatabaseConnection/DatabaseConnection.php';

$db = new DatabaseConnection();

echo json_encode($db->getUtilities((!empty($_POST) ? $_POST : NULL)));
