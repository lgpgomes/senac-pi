<?php
include './connection.php';
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
        <div id="preloader" style="background-color: <?php echo $color;?>">
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
                <a class="nav-link px-3 d-none d-md-block" href="../login/logout.php"><span class="fa fa-sign-out"></span> Sair</a>
            </div>
            <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">            
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">MENU</h5>
                    <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <?php include './nav.php';?>
                </div>
            </div>
        </header>
        

        
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="sidebar col-md-3 col-lg-2 d-md-block sidebar collapse" style="background-color: <?php echo $color ?> !important">
                    <div class="position-sticky pt-3">
                        <?php include './nav.php';?>
                    </div>
                </nav>


                <?php if($tipo == 0){ ?>
                    <main class="conteudo col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        <div class="container mb-4">
                            <p class="h5">Olá Administrador, <?php echo $usuario -> get_nome();?>!</p>
                        </div>
                        <div class="container" id="conteudo">
                            <!--Conteúdo Dinâmico -->
                            <?php include 'home.php';?>
                        </div>
                    </main>
                <?php } ?>


                <?php if ($tipo == 1) { ?>
                    <main class="conteudo col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        <div class="container mb-4">
                            <p class="h5">Olá Funcionário, <?php echo $usuario -> get_nome();?>!</p>
                        </div>
                        <div class="container" id="conteudo">
                            <!--Conteúdo Dinâmico -->
                            <?php include 'home.php';?>
                        </div>
                    </main>
                <?php } ?>


                <?php if($tipo == 2){ ?>
                    <main class="conteudo col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        <div class="container mb-4">
                            <p class="h5">Olá, <?php echo $usuario -> get_nome();?>!</p>
                        </div>
                        <div class="container" id="conteudo">
                            <!--Conteúdo Dinâmico -->
                            <?php include 'home.php';?>
                        </div>
                    </main>
                <?php } ?>
            </div>
        </div>
    </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="../assets/js/main.js"></script>
<script type="text/javascript">
    function btnclick(_url){
        $.ajax({
            url : _url,
            type : 'post',
            success: function(data) {
                $('#conteudo').html(data);
            },
            error: function() {
                $('#conteudo').text('An error occurred');
            }
        });
    }
</script>







