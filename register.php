<?php
$registo = false;

include_once 'assets/DatabaseConnection/DatabaseConnection.php';


//printf($_SERVER['REQUEST_METHOD'] == 'POST');
//printf($_SERVER['REQUEST_METHOD']);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //  echo "entrei";
    $array = filter_input_array(INPUT_POST);
    $username = $array['name'];
    $password = $array['pass'];
    $surname = $array['surname'];
    $regiao = $array['regiao'];
    $email = $array['email'];
    
    
    //echo "olá";
    DatabaseConnection::setUsers($username,$surname, $email, $password, $regiao);
     header('Location: index.php');
    
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="assets/images/home-icon.png"/>
        <link href="assets/css/geral.css" rel="stylesheet" type="text/css"/>
        <title>Register</title>
        <!-- Bootstrap core CSS-->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="assets/endor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
    </head>
    <header>
        <img src="assets/images/home-icon.png" />
    </header>

    <body class="bg-dark" style="background-image:url(assets/images/fundo.png)">
        <img href="assets/images/home-icon.png"/>
        <div class="container">
            <div class="card card-register mx-auto mt-5">
                <div class="card-header">Register an Account</div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="exampleInputName">First name</label>
                                    <input class="form-control" name="name" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter first name">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputLastName">Last name</label>
                                    <input class="form-control" name="surname" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Enter last name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input class="form-control" id="exampleInputEmail1" name="email" type="text" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Regiao</label>
                            <input class="form-control" id="exampleInputEmail1" name="regiao" type="text" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input class="form-control" name="pass" id="exampleInputPassword1" type="password" placeholder="Password">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleConfirmPassword">Confirm password</label>
                                    <input class="form-control" id="exampleConfirmPassword" type="password" placeholder="Confirm password">
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" id="login_submit" value="Sign In"/>
                    </form>
                    <div class="text-center">
                        <a class="d-block small mt-3" href="login.php">Login Page</a>
                        <a class="d-block small" href="forgotPassword.php">Forgot Password?</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    </body>

</html>
