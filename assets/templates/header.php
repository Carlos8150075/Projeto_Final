<nav class="navbar navbar-expand-lg navbar-dark navbar-light bg-light fixed-top" id="mainNav">
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

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Utilities">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-book"></i>
                    <span class="nav-link-text">Utilities</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseComponents">
                    <li>
                        <a href="map.php">Electricidade</a>
                    </li>
                    <li>
                        <a href="map2.php">Àgua</a>
                    </li>


                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Mapa">
                <a class="nav-link" href="map.php">
                    <i class="fa fa-fw fa-refresh"></i>
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
            <li class="nav-item">
                <a class="nav-link" href="login.php">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>

