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
$agendamentosAnteriores = obterAgendamentos($usuario -> get_id());

if($tipo == 0){
    $color = '#002050';
} 
else if ($tipo == 1) {
    $color = '#355AAA';
} 
else if ($tipo == 2) {
    $color = '#121214';
}
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

        <header class="navbar navbar-dark sticky-top flex-md-nowrap" style="background-color: <?php echo $color ?> !important;">
            <a href="../index.html#user"><img src="../assets/img/logo.png" alt="logo mr barbers" class="nav-logo"></a>
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
                    <a class="nav-link active" aria-current="page" href="">
                    <span data-feather="user"></span>
                    Principal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="agendamento.php">
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
                <nav id="sidebarMenu" class="sidebar col-md-3 col-lg-2 d-md-block sidebar collapse" style="background-color: <?php echo $color ?> !important">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">
                                <span data-feather="user"></span>
                                Principal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="agendamento.php"> 
                                <span data-feather="calendar"></span>
                                Agendamentos
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>

                <?php
                if($tipo == 2){
                ?>
                <main class="conteudo col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2>Olá, <?php echo $usuario -> get_nome(); ?>!</h2>
                <h2>Agendamentos Anteriores</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Barbearia</th>
                                <th>Serviço</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $agendamentosAnteriores;?>
                        </tbody>
                    </table>
                </div>
            </main>
            <?php
            }
            ?>

            <?php
            if($tipo == 0){
            ?>
            <main class="conteudo col-md-9 ms-sm-auto col-lg-10 px-md-4">


                <h2>Olá Adm, <?php echo $usuario -> get_nome(); ?>!</h2>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popupFuncionario">
                    Cadastrar Funcionário
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#popupServico">
                    Cadastrar Serviço
                </button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#popupCliente">
                    Cadastrar Cliente
                </button>
                <?php if (isset($_SESSION['msg'])) echo $_SESSION['msg']; unset($_SESSION['msg']); ?>


                <div class="modal fade" id="popupFuncionario" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-md  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cadastrar Funcionário</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">  
                            <form action="cadastrarFuncionario.php" method="POST" id="cadFunc">
                                <div class="row g-3 justify-content-center">
                                    <div class="col-sm-12">
                                        <input type="nome" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control" id="email" name="senha" placeholder="Senha" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control" id="email" name="confirmar_senha" placeholder="Confirmar Senha" required>
                                    </div>
                                </div>
                            </form> 
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" form="cadFunc" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                     </div>
                </div>
                                
                <div class="modal fade" id="popupServico" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-md  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cadastrar Serviço</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">  
                            <form id="cadServ">
                                <div class="row g-3 justify-content-center">
                                    <div class="col-sm-12">
                                        <input type="nome" class="form-control" id="nome" name="nome" placeholder="Nome do Serviço" required>
                                    </div>
                                </div>
                            </form> 
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" form="cadServ" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                     </div>
                </div>  
                
                <div class="modal fade" id="popupCliente" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-md  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cadastrar Cliente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">  
                            <form action="cadastrarCliente.php" method="POST" id="cadUser"> 
                                <div class="row g-3 justify-content-center">
                                    <div class="col-sm-12">
                                        <input type="nome" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control" id="email" name="senha" placeholder="Senha" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control" id="email" name="confirmar_senha" placeholder="Confirmar Senha">
                                    </div>
                                </div>
                            </form> 
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" form="cadUser" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                     </div>
                </div> 
            </main>
            <?php
            }
            ?>

            <?php
            if ($tipo == 1) {
            ?>
            <main class="conteudo col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2>Olá Funcionário, <?php echo $usuario -> get_nome(); ?>!</h2>
                <h2>Agendamentos Anteriores</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Barbearia</th>
                                <th>Serviço</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </main>
            <?php
            }
            ?>

        </body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="../assets/js/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script> feather.replace() </script>
            <script>
            //Remove a classe msgErro apos 5s
            setTimeout(function() {
                $("#msg").fadeOut().empty();
            }, 5000);
            </script>

</html>
