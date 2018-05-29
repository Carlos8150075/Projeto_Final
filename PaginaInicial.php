<?php 


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
        <title>Inicio</title>
        <!--"assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"->
        <!-- Custom styles for this template-->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <script src="assets/js/gastos_gerais_utilities.js" type="text/javascript"></script>
        <script src="assets/js/gastos_gerais_utilities2.js" type="text/javascript"></script>
        <script src="assets/js/generate_cards.js" type="text/javascript"></script>
        <script src="assets/js/utilities_nav.js" type="text/javascript"></script>
        <script type="text/javascript">
                      
                           // alert('ola');
                            
                             var user = "<?php echo $id;?>";
                          //alert(user);
                          localStorage.setItem("utilizadorID",user);
                          
                        </script>
                        
                        <style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial;
}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  .header-right {
    float: none;
  }
}
</style>
    </head>
</head>
<body    >
    <?php
   //include_once './assets/templates/header.php';
    ?>
    
    <div class="header">
        <h1 style="display: inline ">Poupar</h1>
        <img src="assets/images/home-icon.png" style="width: 60px; margin-left: 500px"/>
  <div class="header-right">
    <a  href="login.php">Login</a>
    <a href="register.php">Registo</a>
    <a href="about.php">About</a>
  </div>
</div>
    
    <img src="assets/images/oie_transparent.png" style="zoom: 80%; padding-left: 19% ; padding-top: 80px"> 
    <a class="btn smaller btn-warning" href="index.php" id="toggleNavColor" style="margin-left: 600px ; margin-top: 10px">Get Started</a>
    
    
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
     <script>
    $('#toggleNavColor').click(function() {
      $('nav').toggleClass('navbar-dark navbar-light');
      $('nav').toggleClass('bg-dark bg-light');
      $('body').toggleClass('bg-dark bg-light');
    });

    </script>
    
</body>
</html>
