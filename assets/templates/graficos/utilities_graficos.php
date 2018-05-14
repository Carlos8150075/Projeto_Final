<?php
//session_start();

?>
<div class="content-wrapper" style="margin-top: 50px">    
    <div class="container-fluid">

        <h1 class="pageTitle" style="margin-bottom: 1rem;"> <script>document.write(localStorage.utilitie);</script></h1>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Gráficos</li>
    </ol>
    <!-- Area Chart Example-->
   
    <div class="row">
        
        <div class="card mb-5" >
            <!-- Example Pie Chart Card-->
            <div class="card mb-6" >
                <div class="card-header" id="barras_utilities" >
                    <i class="fa fa-bar-chart"></i> Grafico</div>
                <div class="card-body" style="font-size: 0.7rem">
                    <canvas id="barras_utilities2" style="padding-left:auto;"></canvas>
                    <div class="card-body" id="tableContainer2"></div>
                </div>
                <div class="card-footer small text-muted"></div>
            </div>
            
        </div>
    </div>
</div>
</div>