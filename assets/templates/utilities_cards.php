<div class="content-wrapper" style="padding-top: 80px;">
    <div class="container-fluid">
        
        <h1 class="pageTitle" style="margin-bottom: 1rem;"> <script>document.write(localStorage.ambiente);</script>
            <a onclick="criarlabel()" style="margin-left: 7px " class="btn btn-warning"><i class="fa far fa-edit" ></i></a></h1>
            <div class="form-group" id="mudarNomeA">
           </div>
        
        
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
                        label.innerHTML="Novo Nome :";
                        
                        var input1=document.createElement("input");
                        input1.setAttribute("class","form-control" );
                        input1.setAttribute("placeholder","Ex:casa" );
                        input1.setAttribute("name","novoNome" );
                        
                        
                        
                        
                        
                        var div = document.getElementById("mudarNomeA");
                        div.appendChild(label);
                        div.appendChild(input1);
                        
                        
                        
                    }
                </script>


    </div>
 
