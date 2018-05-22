<?php
    include_once 'assets/DatabaseConnection/DatabaseConnection.php';
    $db = new DatabaseConnection();
    
    $array = $db->getUtilities("");
?>
<div class="content-wrapper" style="padding-top: 80px;">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Ambientes</a>
            </li>

        </ol>

        <hr>
        <!-- Icon Cards-->
        <div class="row" id="cards">

        </div>
<script>
                    function myFunction3() {

                        var ambienteID = event.target.getAttribute('value');
                        var ambiente= event.target.getAttribute('id');
                        if(ambienteID==null){
                            alert('erro');
                           
                        }
                        localStorage.setItem("ambiente",ambiente)
                        localStorage.setItem("ambienteID", ambienteID);

                    }
                </script>

    </div>
 
