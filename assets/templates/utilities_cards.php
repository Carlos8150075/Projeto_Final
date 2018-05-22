<div class="content-wrapper" style="padding-top: 80px;">
    <div class="container-fluid">
        
        <h1 class="pageTitle" style="margin-bottom: 1rem;"> <script>document.write(localStorage.ambiente);</script></h1>
        
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
                </script>


    </div>
 
