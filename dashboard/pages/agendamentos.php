<?php
require_once '../../banco/banco.php';
require_once '../../usuario/usuario.php';
require_once '../util/connection.php';
?>

<?php 
if($tipo == 1) {
    $tipoUsuario = 'Cliente'; 
} else { 
    $tipoUsuario = 'Profissional'; 
}
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
            <p class="h4"> Você não fez nenhum agendamento ainda... </p>
            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#popupAgendamento">
                Fazer Agendamento
            </button>
            </div>
        </div>
    </div>
<?php } ?>
