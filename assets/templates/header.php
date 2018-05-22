<?php
include_once 'assets/DatabaseConnection/DatabaseConnection.php';
$db = new DatabaseConnection();
// $user_logado = $db->getUser();

error_reporting(E_ALL ^ E_NOTICE);
session_start();
?>


<nav class="navbar navbar-expand-lg  navbar-light bg-light fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php"><img src="assets/images/home-icon.png" style="width: 30px;"/></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="index.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>


            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Registos">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-book"></i>
                    <span class="nav-link-text">Registos</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseComponents">
                    <li>

                        <a href="add_Registos.php">
                            <i class="fa smaller fas fa-plus"></i> Adicionar Registos</a>
                    </li>
                    <li>
                        <a href="Registos.php">
                            <i class="fa smaller fa-fw fa-book"></i> Tabela de Registos</a>
                    </li>



                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fas fa-cogs"></i>
                    <span class="nav-link-text">Gestao de Utilities</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseMulti">

                    <li>
                        <a href="add_utility.php">
                            <i class="fa smaller fa-fw fa-book"></i> Adicionar Utility</a>
                    </li>

                    <li>
                        <a href="Utilities.php">
                            <i class="fa smaller fa-fw fa-book"></i> Registo das utilities</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Utilities">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-book"></i>
                    <span class="nav-link-text">Utilities</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePages">





                </ul>

                <script>
                    function myFunction() {


                        var utilitie = event.target.innerHTML;
                        var utilityID = event.target.getAttribute('value');

                        localStorage.setItem("utilitie", utilitie);
                        localStorage.setItem("utilityID", utilityID);

                    }
                </script>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Mapa">
                <a class="nav-link" href="map2.php">
                    <i class="fa fa-fw far fa-globe"></i>
                    <span class="nav-link-text">Mapa</span>
                </a>
            </li>

            

        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="welcome">

            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-envelope"></i>
                    <span class="d-lg-none">Messages
                        <span class="badge badge-pill badge-primary">12 New</span>
                    </span>
                    <span class="indicator text-primary d-none d-lg-block">
                        <i class="fa fa-fw fa-circle"></i>
                    </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">New Messages:</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>Pessoa</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">Hiii there! ..... </div>
                    </a>
                    <div class="dropdown-divider"></div>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item small" href="#">View all messages</a>
                </div>
            </li>


            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0 mr-lg-2">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for...">
                        <span class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </li>

            <li class="welcome text-secondary">
                Bem-vindo, <li id="utilizador" class="welcome text-secondary"><?php echo $_SESSION['user'] ?></li>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2 text-secondary" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fas fa-cogs "></i>

                </a>
                <div class="dropdown-menu bg-light" aria-labelledby="messagesDropdown">


                    <a class="dropdown-item" href="perfil.php">


                        <div class="dropdown-message"><i class="fa far fa-user" ></i> 	&nbsp; Perfil</div>

                    </a><div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="perfil.php">

                        <div class="dropdown-message ">  <i class="fa fa-fw fas fa-cogs "></i>&nbsp;Definições</div>
                    </a>


                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-secondary" href="logout.php">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>


