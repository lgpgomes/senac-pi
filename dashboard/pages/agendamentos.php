<?php
require_once '../../banco/banco.php';
require_once '../../usuario/usuario.php';
require_once '../util/connection.php';
require_once '../../clientes/cliente.php';

if($tipo == 1) {
    $tipoUsuario = 'Cliente'; 
} else { 
    $tipoUsuario = 'Profissional'; 
}
?>

<?php
if($tipo == 0) {

$todosAgendamentos = obterTodosAgendamentos();
?>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Data</th>
            <th>Serviço</th>
            <th>Cliente</th>
            <th>Funcionário</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($todosAgendamentos as $row) {?>
        <tr>
            <td><?php echo $row['DATA_HORA']; ?></td>
            <td><?php echo $row['DESCRICAO']; ?></td> 
            <td><?php echo $row['NOME_CLIENTE']; ?></td>
            <td><?php echo $row['NOME_FUNCIONARIO']; ?></td> 
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } ?>

<?php
if($tipo == 1 || $tipo == 2) {

$agendamentosPendentes = obterAgendamentos($id, $tipo, STATUS_AGENDAMENTO_PENDENTE);
$agendamentosCancelados = obterAgendamentos($id, $tipo, STATUS_AGENDAMENTO_CANCELADO);
$agendamentosConcluidos = obterAgendamentos($id, $tipo, STATUS_AGENDAMENTO_CONCLUIDO);
?>
<?php if($agendamentosPendentes -> rowCount() > 0) {?>
    <p class="h5">Agendamentos Pendentes</p>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Data</th>
                <th><?php echo $tipoUsuario;?></th>
                <th>Serviço</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($agendamentosPendentes as $row) {?>
            <tr>
                <td><?php echo $row['data_hora']; ?></td>
                <td><?php echo $row['nome']; ?></td> 
                <td><?php echo $row['descricao']; ?></td>
                <?php if ($tipo == 1) { ?>
                <td><?php $id_agendamento =  $row['id']; ?></td>
                <td>
                    <a onclick="statusAgend(<?php echo $row['id'];?>, <?php echo STATUS_AGENDAMENTO_CONCLUIDO; ?>)" type="button" class="btn btn-secondary btn-sm"><i class="fa fa-check"></i> Concluir </a>
                    <a onclick="statusAgend(<?php echo $row['id'];?>, <?php echo STATUS_AGENDAMENTO_CANCELADO; ?>)" type="button" class="btn btn-secondary btn-sm"><i class="fa fa-times"></i> Cancelar </a>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>


<?php if($agendamentosConcluidos -> rowCount() > 0) {?>
    <p class="h5">Agendamentos Concluídos</p>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Data</th>
                <th><?php echo $tipoUsuario;?></th>
                <th>Serviço</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($agendamentosConcluidos as $row) {?>
            <tr>
                <td><?php echo $row['data_hora']; ?></td>
                <td><?php echo $row['nome']; ?></td> 
                <td><?php echo $row['descricao']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php if($agendamentosCancelados -> rowCount() > 0) {?>
    <p class="h5">Agendamentos Cancelados</p>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Data</th>
                <th><?php echo $tipoUsuario;?></th>
                <th>Serviço</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($agendamentosCancelados as $row) {?>
            <tr>
                <td><?php echo $row['data_hora']; ?></td>
                <td><?php echo $row['nome']; ?></td> 
                <td><?php echo $row['descricao']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php if($agendamentosPendentes -> rowCount() == 0 && $agendamentosCancelados -> rowCount() == 0 && $agendamentosConcluidos -> rowCount() == 0 ) {?>
    <div class="agendavazia d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col">
                <?php if ($tipo == 1) {?>
                    <p class="h4"> Nenhum agendamento encontrado para você ainda... </p>
                <?php } else if ($tipo == 2) { ?>
                    <p class="h4 mb-2"> Você não fez nenhum agendamento ainda... </p>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#popupAgendamento">
                        Fazer Agendamento!
                    </button>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php } ?>
