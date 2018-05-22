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
                        if(ambienteID==null){
                            alert('erro');
                           
                        }
         
                        localStorage.setItem("ambienteID", ambienteID);

                    }
                </script>

    </div>
 
