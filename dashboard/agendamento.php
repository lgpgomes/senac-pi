<?php
require '../banco/banco.php';
require '../usuario/usuario.php';
session_start();

if(!isset($_SESSION['usuario'])) {
    header('Location: ../login/login.php');
    return;
}

$tipo = $_SESSION['usuario'] -> get_tipo();

$usuario =  $_SESSION['usuario'];
$profissionais = obterFuncionarios();
$servicos = obterServicos();
?>
<?php
if($tipo == 2){
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <link rel="shortcut icon" href="../assets/img/favicon.png">
        <meta charset="UTF-8" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Dashboard do usuário</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="../assets/css/dashboard.css" rel="stylesheet">
    </head>
    <body>
        <div id="preloader">
            <div class="inner">
                <div class="bolas">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap">
            <a href="../index.html#home"><img src="../assets/img/logo.png" alt="logo mr barbers" class="nav-logo"></a>
            <div class="navbar-nav ">
                <div class="nav-item text-nowrap">
                <a class="nav-link px-3 d-none d-md-block" href="../login/logout.php"><span data-feather="log-out"></span> Sair</a>
            </div>

            <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
        </header>
        
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">            
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">MENU</h5>
                <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="dashboard.php">
                    <span data-feather="home"></span>
                    Principal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                    <span data-feather="calendar"></span>
                    Agendamentos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login/logout.php">
                    <span data-feather="log-out"></span>
                    Sair
                    </a>
                </li>
                </ul>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="sidebar col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="dashboard.php">
                                <span data-feather="home"></span>
                                Principal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#">
                                <span data-feather="calendar"></span>
                                Agendamentos
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                
            <main class="conteudo col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popupAgendamento">
                    Sextou
                </button>
                
                <div class="modal fade" id="popupAgendamento" tabindex="-1" aria-labelledby="popupAgendamentoLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Faça Seu Agendamento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="#" class="form-agendamento">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-sm-6">
                                            <input type="date" min="<?php echo date('Y-m-d');?>" max="2023-12-25" class="form-control" name="data" placeholder="Data">
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="" id="" class="form-select hour">
                                                <option disabled selected>Hora</option>
                                                <option>8h</option>
                                                <option>9h</option>
                                                <option>10h</option>
                                                <option>11h</option>
                                                <option>12h</option>
                                                <option>13h</option>
                                                <option>14h</option>
                                                <option>15h</option>
                                                <option>16h</option>
                                                <option>17h</option>
                                                <option>18h</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="" id="" class="form-select">
                                                <option disabled selected>Serviços</option>
                                                <?php echo $servicos;?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="" id="" class="form-select">
                                                <option disabled selected>Profissional</option>
                                                <?php echo $profissionais;?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Messagem"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>      
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary">Agendar Agora</button>
                            </div>
                        </div>
                     </div>
                </div>                          
            </main>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
            <script src="../assets/js/main.js"></script>
            <script> feather.replace()</script>
        </body>

</html>

<?php
}
?>