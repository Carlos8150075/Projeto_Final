<?php
$registo = false;

include_once 'assets/DatabaseConnection/DatabaseConnection.php';

require_once __DIR__ . '/Config.php';
//require_once Config::getApplicationServicesPath() . 'RemenberMeService.php';
require_once Config::getApplicationValidatorPath() . 'validateUsers.php';

session_start();

$utilizador = $_SESSION['user'];


//printf($_SERVER['REQUEST_METHOD'] == 'POST');
//printf($_SERVER['REQUEST_METHOD']);

//echo 'inicio';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo "entrei";
    $array = filter_input_array(INPUT_POST);
  //  $username = $array['name'];
    $utility = $array['utility'];
    $valor = $array['valor'];
    $date = $array['date'];

     
     $_SESSION['id']= DatabaseConnection::getUserByEmail($utilizador);
     
     $id=$_SESSION['id'];
     
     DatabaseConnection::addRegistos($id, $utility, $valor, $date);
   
    //$errors = ValidateUser::validadeSignin($email, $password, $password2, $username, $surname);
   // var_dump($errors);
   // if (empty($errors)) {
        //echo "sem erros";
     //   DatabaseConnection::setUsers($username, $utility, $valor, $date);
      //  header('Location: index.php');
 //   }
}
?>
<html>
    <head>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="assets/images/home-icon.png"/>
        <title>Add Registos</title>
        <!--"assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"->
        <!-- Custom styles for this template-->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <script src="assets/js/gerate_addutilitie.js" type="text/javascript"></script>
    </head>
</head>
<body>
    <?php
   include_once './assets/templates/header.php';
    ?>
    
    
    <div style="margin-top: 50px;margin-left: 500px;  padding-right:400px ; " >
    <div class="card  mx-auto mt-5">
      <div class="card-header">Adicionar registo</div>
      <div class="card-body">
        <form method="post">
            
            <div class="form-group">
                            <label for="exampleInputEmail1">Utility</label>
                            <select name="utility" aria-controls="dataTable" class="form-control form-control-sm" id="addUtilitie">
        
                            </select>
                        </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Valor:</label>
            <input class="form-control" name='valor' id="exampleInputEmail1" >
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Data: </label>
            <input class="form-control" id="exampleInputPassword1" name="date" type="date" placeholder="Password">
          </div>
          <input type="submit" name='submit' value="Adicionar" class="btn btn-primary btn-block">
        </form>
        
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
