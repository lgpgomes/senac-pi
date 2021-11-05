<?php 
require '../clientes/cliente.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];
    
    if(cadastrarServico($descricao)) {
        header('Location: dashboard.php');
        $_SESSION['msg'] = '<div id="msg" class="msgSucesso"><i class="fa fa-check"></i> <span>Cadastro Realizado!</span> </div>';
    } 
    else {
        header('Location: dashboard.php');
        $_SESSION['msg'] = '<div id="msg" class="msgErro"><i class="fa fa-exclamation-triangle"></i> <span>Ocorreu Um Erro!</span> </div>';
    }
}
?>