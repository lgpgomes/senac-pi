<?php
session_start();
//Verifica se usuário está logado
if(!isset($_SESSION['usuario'])) {
    header('Location: ../login/login.php');
    return;
}

//Sessão Login;
$usuario =  $_SESSION['usuario'];
//Tipo usuário (0, 1, 2)
$tipo = $usuario -> get_tipo();
//Id usuário
$id = $usuario -> get_id();
//Primeiro nome usuário
$nome = explode(" ", $usuario -> get_nome());

//Cores dashboard, conforme tipo user
if($tipo == 0){
    $color = '#17477F';
    $tipoUsuario = "Administrador";
} 
else if ($tipo == 1) {
    $color = '#1e438b';
    $tipoUsuario = "Funcionário";
} 
else if ($tipo == 2) {
    $color = '#121214';
    $tipoUsuario = "Cliente";
}
?>