<?php 

require_once 'assets/DatabaseConnection/DatabaseConnection.php';
$db = new DatabaseConnection();

session_start();

//$userDeath = $db->getUsers(array("id" => $death['entity_id']))[0];

error_reporting(E_ALL ^ E_NOTICE); 

if (empty($_SESSION['user'])) {
    header("Location: login.php");
}
$user = $db->getUsers(array("id" => $_SESSION['id']))[0];
    $id = $_SESSION['id'];

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="assets/images/home-icon.png"/>
        <title>Dashboards</title>
        <!--"assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"->
        <!-- Custom styles for this template-->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <script src="assets/js/utilities_nav.js" type="text/javascript"></script>
        <script src="assets/js/gastos_gerais_utilities.js" type="text/javascript"></script>
        <script type="text/javascript">
                      
                           // alert('ola');
                            
                             var user = "<?php echo $id;?>";
                          //alert(user);
                          localStorage.setItem("utilizadorID",user);
                          
                        </script>
    </head>
</head>
<body>
    <?php
    include_once './assets/templates/header.php';
    ?>
    
    
<div class="content-wrapper" style="height: 100%"> 
    <div class="container-fluid" style="margin-top: 120px">
        <div class="card mb-3"  style="width: 66%; margin-left: 16.667%">
            <div class="card-header">
                <i class="fa fa-user" style="margin-left: 5px"></i>	&nbsp;Perfil</div>
                
            <div class="panel-body ">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>ID :</td>
                            <td><?php echo $id ?></td>
                        </tr>
                        <tr>
                            <td>Name :</td>
                            <td><?=  $user['name'];?></td>
                            
                        </tr>
                        <tr>
                         <td>Username</td>
                            <td><?=  $user['surname'] ;?></td>
                        </tr>
                        <tr>
                            <td>Regiao :</td>
                            <td> <?= $user['regiao']?></td>
                        </tr>
                        <tr>
                            <td>Email :</td>
                            <td><?php echo $_SESSION['user'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a data-toggle="tooltip" type="button" class="btn btn-sm btn-light" href="index.php"style="height: 38px;">Inicio</i></a>
              
            </div> 

        </div>
    </div>
</div>
    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>
    <!-- Custom scripts for this page-->
    
</body>
</html>
