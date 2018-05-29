<?php
$registo = false;

include_once 'assets/DatabaseConnection/DatabaseConnection.php';

session_start();


if (empty($_SESSION['user'])) {
    header("Location: login.php");
}


$utilizador = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo "entrei";
    $array = filter_input_array(INPUT_POST);
    //  $username = $array['name'];
    $nameNovo = $array['novoNome'];
   
    
    DatabaseConnection::updateAmbiente($id,$nameNovo );
    
     //header('Location: index.php');
    
    

    //$errors = ValidateUser::validadeSignin($email, $password, $password2, $username, $surname);
    // var_dump($errors);
    // if (empty($errors)) {
    //echo "sem erros";
    //   DatabaseConnection::setUsers($username, $utility, $valor, $date);
    //  header('Location: index.php');
    //   }
}
?>


<div class="content-wrapper" style="padding-top: 80px;">
    <div class="container-fluid">

        <h1 class="pageTitle" style="margin-bottom: 1rem;"> <script>document.write(localStorage.ambiente);</script>
            <a onclick="criarlabel()" style="margin-left: 7px " class="btn btn-light"><i class="fa far fa-edit" ></i></a></h1>

        <form method="post">
            <div class="form-group" id="mudarNomeA">
            </div>

            

        </form>



        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a >Utilities</a>
            </li>

        </ol>

        <hr>
        <!-- Icon Cards-->
        <div class="row" id="cardsUtilities">

        </div>

        <script>
            function myFunction2() {


                var utilitie = event.target.innerHTML;
                var utilityID = event.target.getAttribute('value');

                localStorage.setItem("utilitie", utilitie);
                localStorage.setItem("utilityID", utilityID);
                

            }
            
    function criarlabel() {
                var label = document.createElement("label");
                label.innerHTML = "Novo Nome :";

                var input1 = document.createElement("input");
                input1.setAttribute("class", "form-control");
                input1.setAttribute("placeholder", "Ex:casa");
                input1.setAttribute("name", "novoNome");

                 var submit= document.createElement("input");
                 submit.setAttribute("type","submit");
                 submit.setAttribute("class","btn btn-primary btn-block");
                 submit.setAttribute("name","submit");
                 submit.setAttribute("style","margin-top:20px");
                 
                 
                 
                 



                var div = document.getElementById("mudarNomeA");
                div.appendChild(label);
                div.appendChild(input1);
                div.appendChild(submit);



            }
            
            
            
            function updateAmbiente() {
    $.ajaxSetup({async: false});


    var userID = localStorage.ambienteID;
    
            var user = "<?php echo $nameNovo;?>";
            
           

    $.post("assets/Services/changeAmbienteService.php", {nome: user , id: userID})
            .fail(function () {
                alert('Ajax error');
            });


}


            
        </script>


    </div>

