<?php
session_start();

if(!isset($_SESSION['usuario'])) {
    header('Location: ../login/login.php');
    return;
}

$usuario =  $_SESSION['usuario'];
$tipo = $usuario -> get_tipo();

$todosAgendamentos = obterTodosAgendamentos();
$agendamentosPendentes = obterAgendamentos($usuario -> get_id(), $tipo, STATUS_AGENDAMENTO_PENDENTE);
$agendamentosCancelados = obterAgendamentos($usuario -> get_id(), $tipo, STATUS_AGENDAMENTO_CANCELADO);
$agendamentosConcluidos = obterAgendamentos($usuario -> get_id(), $tipo, STATUS_AGENDAMENTO_CONCLUIDO);

$clientes = obterClientes();
$servicos = obterServicos();
$funcionarios = obterFuncionarios();
$charts = charts();

if($tipo == 0){
    $color = '#002050';
} 
else if ($tipo == 1) {
    $color = '#1e438b';
} 
else if ($tipo == 2) {
    $color = '#121214';
}
?>