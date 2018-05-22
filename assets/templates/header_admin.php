<?php
include_once 'assets/DatabaseConnection/DatabaseConnection.php';
$db = new DatabaseConnection();
// $user_logado = $db->getUser();

error_reporting(E_ALL ^ E_NOTICE);
session_start();
?>


<nav class="navbar navbar-expand-lg navbar-dark navbar-light bg-light fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php"><img src="assets/images/home-icon.png" style="width: 30px;"/></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive" >
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
                        <a href="Registos_admin.php">
                            <i class="fa smaller fa-fw fa-book"></i> Tabela de Registos</a>
                    </li>



                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fas fa-cogs"></i>
                    <span class="nav-link-text">Gestao de Utilizadores</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseMulti">

                    <li>
                        <a href="add_utility.php">
                            <i class="fa smaller fa-fw fa-book"></i>Remover Utilizador</a>
                    </li>

                    <li>
                        <a href="Utilizadores_table.php">
                            <i class="fa smaller fa-fw fa-book"></i> Tabela dos utilizadores</a>
                    </li>

                </ul>
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
            
            <h1 style="font-size: 30px ; padding-right: 150px"  >Administrador</h1>

            

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


