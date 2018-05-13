<?php
include_once 'assets/DatabaseConnection/DatabaseConnection.php';

require_once __DIR__ . '/Config.php';
//require_once Config::getApplicationServicesPath() . 'RemenberMeService.php';
require_once Config::getApplicationValidatorPath() . 'validateUsers.php';
/*if (isset($_SESSION['user'])) {
    DatabaseConnection::addAccess($_SESSION['user']);
    header('Location: index.php');
}*/

session_start();
$incorrect = "";
$login = TRUE;
 //echo 'nao entrei';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // echo 'entrei';
    $array = filter_input_array(INPUT_POST);
    $errors = ValidateUser::validateLogin($array['email'], $array['pass']);
    $username = $array['email'];
    $password = $array['pass'];
    var_dump($errors);
    if (empty($errors)) {
       /* if (isset($array['remenber'])) {
            setcookie('email', $array['email'], time() + (3600 * 24), '/');
            setcookie('password', $array['password'], time() + (3600 * 24), '/');
        }*/
        //echo 'entrei2';
        $_SESSION['user'] = $username;
        header('Location: index.php');
    } else if (!isset($errors['email'])) {
        $email = $array['email'];
    }
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
  <title>Login</title>
  <!-- Bootstrap core CSS-->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">
</head>
<header>
    <img src="assets/images/home-icon.png" />
</header>

<body class="bg-dark" style="background-image:url(assets/images/fundo.png)">
  <div class="container" >
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control" name='email' id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" name="pass" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div>
          <input type="submit" name='submit' value="Log In" class="btn btn-primary btn-block">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
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
