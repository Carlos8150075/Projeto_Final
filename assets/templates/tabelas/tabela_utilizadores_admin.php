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
                    <table class="table table-bordered" id="dataTableadmin" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Regiao</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="utilizaadoresTableadmin">
                        </tbody>
                    </table>
                </div>
 <script>
                    function myFunctionUtilizadores() {


                        var utilizadoresID = event.target.getAttribute('id');

                        localStorage.setItem("utilizadoresID", utilizadoresID);

                    }
                </script>

            </div>
        </div>
    </div>
</div>
