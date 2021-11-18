
<?php
require_once '../usuario/usuario.php';
require_once '../banco/banco.php';

session_start();

$mensagemErro = '';

if(empty($_SESSION['email'])) {
    header('Location: reset.php');
} 

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_digitada = $_POST['date'];
    $data_db = "";
    foreach(validarUsuario($_SESSION['email']) as $row) {
        $data_db = $row['DATA_HORA'];
        $tipo = $row['TIPO'];
    }
    if ($tipo == 1) {
        $mensagemErro = '<div id="msg" class="msgErro"><i class="fa fa-exclamation-triangle"></i> <span> Você É Um Funcionário, Contate O ADM!</span> </div>';
    } else if ($tipo == 0) {
        $mensagemErro = '<div id="msg" class="msgErro"><i class="fa fa-exclamation-triangle"></i> <span> Você É Um ADM, Contate O Suporte!</span> </div>';
    } else {
        $newdate = date('Y-m-d', strtotime('-8 days', strtotime($data_db)));
        for($i = 0;$i < 15;$i++) {
            $newdate = date('Y-m-d', strtotime('+1 days', strtotime($newdate)));
            if($newdate == $data_digitada){
                $_SESSION['token'] = rand(1000,9999);
                header('Location: resetPassword.php');
            }
        }
        $mensagemErro = '<div id="msg" class="msgErro"><i class="fa fa-exclamation-triangle"></i> <span> Data Incorreta!</span> </div>';
    }
} 

?>

<!DOCTYPE html>
<html>
    <head>
        <!--Favicon-->
        <link rel="shortcut icon" href="../assets/img/favicon.png">
        <meta charset="UTF-8" />
        <!--Fonte-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>MR BARBER'S | Agendamento Para Barbearias</title>
        <!--Bootstrap CSS-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!--CSS-->
        <link rel="stylesheet" href="../assets/css/custom-styles.css"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body databs-spy="scroll" data-bs-target=".nav-bg">
        <header class="header" id="home">
            <!--Preloader-->
            <div id="preloader">
                <div class="inner">
                    <div class="bolas">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
            <nav class="navbar fixed-top navbar-expand-lg navbar-dark">
                <div class="container">
                    <a href="../#home"><img src="../assets/img/logo.png" alt="logo mr barbers" class="nav-logo"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class='offcanvas offcanvas-start' data-bs-scroll="true" tabindex='-1' id='offcanvasExample' aria-labelledby='offcanvasExampleLabel'>
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title">Menu</h5>
                            <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body" id="navbarNav">
                            <div class="mx-auto"></div>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="../#home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="../#servicos">Serviços</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="../#sobre">Sobre</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="../#contato">Contato</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="../#agendamento">Agendamento</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        </header>
        <section class="login-section" id="login-section">
            <div class="container" id="login">
                <div class="d-flex justify-content-center h-100">
                    <div class="card" id="login-card">
                        <div class="card-header">
                            <h4>Qual A Data Do Seu Último Agendamento?</h4>
                        </div>
                        <div class="card-body">
                            <form action="resetValidator.php" method="POST">
                                <div class="input-group form-group py-1">
                                    <input type="date" name="date" class="form-control" id="data" required>
                                </div>
                                <div class="form-group py-2">
                                    <input type="submit" value="Confirmar" class="btn float-right login_btn" >
                                </div>
                                <?php
                                echo $mensagemErro;
                                ?>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center links">
                                <span><a href="../clientes/cadastro.php">Criar Cadastro</a> ou <a href="../login/login.php">Fazer Login</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--Javascript-->
    <script src="../assets/js/main.js"></script>
    <script>
    //Remove a classe msgErro apos 5s
        setTimeout(function() {
            $("#msg").fadeOut().empty();
        }, 5000);
    </script>
</html>