<?php
require_once '../banco/banco.php';
require_once '../usuario/usuario.php';
require_once './util/connection.php';
require_once '../clientes/cliente.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <link rel="shortcut icon" href="../assets/img/favicon.png">
        <meta charset="UTF-8" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="../assets/css/dashboard1.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css"/>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    </head>
    <body>
        <!--Preloader-->
        <div id="preloader" style="background-color: <?php echo $color;?>">
            <div class="inner">
                <div class="bolas">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
        <!--Header-->
        <header class="navbar navbar-dark sticky-top flex-md-nowrap" style="background-color: <?php echo $color ?> !important;">
            <a href="../index.php"><img src="../assets/img/logo.png" alt="logo mr barbers" class="nav-logo"></a>
            <div class="navbar-nav ">
                <div class="nav-item text-nowrap">
                <a class="nav-link px-3 d-none d-md-block" href="../login/logout.php"><span class="fa fa-sign-out"></span> Sair</a>
            </div>
            <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
        </header>
        <!--Offcanvas Mobile-->
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasExample" style="background-color: <?php echo $color ?>">
                <div class="offcanvas-header">            
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">MENU</h5>
                    <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="nav flex-column" id="navoff">
                        <li class="nav-item">
                        </li>
                    </ul>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="../login/logout.php"><span class="fa fa-sign-out"></span> Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--SideBar & Main-->
            <div class="container-fluid">
                <div class="row">
                    <nav id="sidebarMenu" class="sidebar col-md-3 col-lg-2 d-md-block sidebar collapse" style="background-color: <?php echo $color ?> !important">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column" id="navside">
                        </ul>
                    </div>
                </nav>
                
                <!--Conteudo Principal-->
                <main class="conteudo col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <!--Modais (Popups)-->    
                    <div id="modal"></div>
                    <!---->
                    <div class="container p-0 mb-4">
                        <p class="h6">Olá <?php echo $tipoUsuario.', '.$nome[0];?>!</p>
                    </div>
                    <!--Alerts-->        
                    <div class="alert alert-dismissible d-flex align-items-center d-none gap-1" role="alert">
                        <span id="iconeAlert" class="fa "></span>
                        <span id="msg"></span>
                        <button onclick="hiddenAlert();" type="button" class="btn-close"></button>
                    </div>    
                    <!--Spinner-->
                    <div id="spinner">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="loader spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <!--Conteúdo Dinâmico -->
                    <div class="container p-0" id="conteudo">
                        <!--(Conteúdo)-->
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script src="./pages/dashboard.js"></script>
<script src="../assets/js/main.js"></script>