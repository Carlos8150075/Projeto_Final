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


        <div class="card mb-3" >
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Grafico de barras</div>
            <div class="card-body" id="utility_linhasContainer">
                <label style="margin-left: 50px">De</label>
                <select id='monthFrom'class="btn btn-default dropdown-toggle">
                    <option selected value='1'>Janeiro</option>
                    <option value='2'>Fevereiro</option>
                    <option value='3'>Março</option>
                    <option value='4'>Abril</option>
                    <option value='5'>Maio</option>
                    <option value='6'>Junho</option>
                    <option value='7'>Julho</option>
                    <option value='8'>Agosto</option>
                    <option value='9'>Setembro</option>
                    <option value='10'>Outubro</option>
                    <option value='11'>Novembro</option>
                    <option value='12'>Dezembro</option>
                </select> 
                <select id='yearFrom'class="btn btn-default dropdown-toggle"></select>
                <label>Até</label>
                <select id='monthTo'class="btn btn-default dropdown-toggle">
                    <option value='1'>Janeiro</option>
                    <option value='2'>Fevereiro</option>
                    <option value='3'>Março</option>
                    <option value='4'>Abril</option>
                    <option value='5'>Maio</option>
                    <option value='6'>Junho</option>
                    <option value='7'>Julho</option>
                    <option value='8'>Agosto</option>
                    <option value='9'>Setembro</option>
                    <option value='10'>Outubro</option>
                    <option value='11'>Novembro</option>
                    <option selected value='12'>Dezembro</option>
                </select> 
                <select id='yearTo'class="btn btn-default dropdown-toggle"></select>
                <button class="btn btn-black" id="reporGrafico" style="margin-left: 420px" >Clear</button>

                <canvas id="utilities_linhas" width="100%" height="30"></canvas>
                <div class="card-body" id="tableContainer"></div>
            </div>
            <div class="card-footer small text-muted"></div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-3" >
                <!-- Example Pie Chart Card-->

                <div class="card-header" id="barras_utilities" >
                    <i class="fa fa-bar-chart"></i> Grafico de barras</div>
                <div class="card-body" style="font-size: 0.7rem">
                    <canvas id="barras_utilities2" style="padding-left:auto;"></canvas>
                    <div class="card-body" id="tableContainer2"></div>
                </div>
                <div class="card-footer small text-muted"></div>

</div>
            </div>
            <div class="col-lg-8">
                <!-- Example Bar Chart Card-->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-pie-chart"></i>Grafico Circular</div>
                    <div class="card-body">
                        <canvas id="utilities_circular" width="100" height="50"></canvas>
                    </div>
                    <div class="card-footer small text-muted"></div>
                </div>
            </div>
        

    </div>
</div>