<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb" style="margin-top: 60px">
            <li class="breadcrumb-item active">Utilities</li>
        </ol>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Tabela das Utilities</div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nº da Utility</th>
                                <th>Ambiente</th>
                                <th>Nome</th>
                                <th>Metrica</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div><script>
        function myFunctionUtiliess() {


            var delUtilID = event.target.getAttribute('id');

            localStorage.setItem("delUtilID", delUtilID);

        }
    </script>

</div>
