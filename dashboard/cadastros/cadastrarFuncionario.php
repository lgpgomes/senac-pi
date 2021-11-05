<?php 
require '../clientes/cliente.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $email = $_POST['email'];
    $Mensagem = cadastrarUsuario($nome, $senha, $confirmar_senha, $email, TIPO_USUARIO_FUNCIONARIO);

    if(isset($Mensagem)) {
        header('Location: dashboard.php');
        $_SESSION['msg'] = $Mensagem;
    } 
    else {
        header('Location: dashboard.php');
        $_SESSION['msg'] = '<div id="msg" class="msgSucesso"><i class="fa fa-check"></i> <span>Cadastro Realizado!</span> </div>';
    }


}
?>