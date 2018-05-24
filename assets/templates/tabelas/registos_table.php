<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb" style="margin-top: 60px">
            <li class="breadcrumb-item active">Registos</li>
        </ol>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Tabela dos registos gerais</div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                        <thead>
                            <tr>
                                <th>Nº do Registo</th>
                                <th>Utility</th>
                                <th>Valor</th>
                                <th>Data</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                        </tbody>
                    </table>
                </div>
                
                <script>
                    function myFunctionRegistos() {


                        var registoID = event.target.getAttribute('id');

                        localStorage.setItem("registoID", registoID);

                    }
                </script>


            </div>
        </div>
    </div>
</div>
