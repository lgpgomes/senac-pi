<?php
session_start();

if(!isset($_SESSION['usuario'])) {
    header('Location: ../login/login.php');
    return;
}

$usuario =  $_SESSION['usuario'];
$tipo = $usuario -> get_tipo();
$id = $usuario -> get_id();

if($tipo == 0){
    $color = '#17477F';
} 
else if ($tipo == 1) {
    $color = '#1e438b';
} 
else if ($tipo == 2) {
    $color = '#121214';
}
?>