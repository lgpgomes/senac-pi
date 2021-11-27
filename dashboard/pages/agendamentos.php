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
<!-- Tabela Todos Agendamentos -->
<div class="card shadow mb-4">
    <div class="card-header justify-content-between align-items-center d-flex">
        <h6 id="titletable" class="m-0">Todos Agendamentos</h6>
    </div>
    <div class="card-body">
        <div class="tableAdmin table-responsive">
            <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            <td><?php echo date("d/m/Y - H:i", strtotime($row['DATA_HORA'])) ; ?></td>
                            <td><?php echo $row['DESCRICAO']; ?></td> 
                            <td><?php echo $row['NOME_CLIENTE']; ?></td>
                            <td><?php echo $row['NOME_FUNCIONARIO']; ?></td> 
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } ?>
<!--Agendamentos Cliente e Funcionario-->
<?php
if($tipo == 1 || $tipo == 2) {
$agendamentosPendentes = obterAgendamentos($id, $tipo, STATUS_AGENDAMENTO_PENDENTE);
$agendamentosCancelados = obterAgendamentos($id, $tipo, STATUS_AGENDAMENTO_CANCELADO);
$agendamentosConcluidos = obterAgendamentos($id, $tipo, STATUS_AGENDAMENTO_CONCLUIDO);

?>
<?php if($agendamentosPendentes -> rowCount() > 0) {?>
<div class="card shadow mb-4">
    <div class="card-header justify-content-between align-items-center d-flex">
        <h6 id="titletable" class="m-0">Agendamentos Pendentes</h6>
    </div>
    <div class="card-body">
        <div class="tableAdmin table-responsive">
            <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th><?php echo $tipoUsuario;?></th>
                        <th>Serviço</th>
                        <?php if($tipo == 1) {?>
                        <th>Ações</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($agendamentosPendentes as $row) {?>
                        <tr>
                            <td><?php echo date("d/m/Y - H:i", strtotime($row['data_hora'])) ; ?></td>
                            <td><?php echo $row['nome']; ?></td> 
                            <td><?php echo $row['descricao']; ?></td>
                            <?php if ($tipo == 1) { ?>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn btn-outline-secondary" onclick="statusAgend(<?php echo $row['id'];?>, <?php echo STATUS_AGENDAMENTO_CONCLUIDO; ?>)" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-check"></i>
                                        <span class="d-none d-xl-inline">Concluir</span>
                                    </button>
                                    <button type="button" class="btn btn btn-outline-secondary" onclick="statusAgend(<?php echo $row['id'];?>, <?php echo STATUS_AGENDAMENTO_CANCELADO; ?>)" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-times"></i>
                                        <span class="d-none d-xl-inline">Cancelar</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } ?>


<?php if($agendamentosConcluidos -> rowCount() > 0) {?>
<div class="card shadow mb-4">
    <div class="card-header justify-content-between align-items-center d-flex">
        <h6 id="titletable" class="m-0">Agendamentos Concluídos</h6>
    </div>
    <div class="card-body">
        <div class="tableAdmin table-responsive">
            <table class="table table-sm table-bordered" id="dataTable1" width="100%" cellspacing="0">
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
                            <td><?php echo date("d/m/Y - H:i", strtotime($row['data_hora'])) ; ?></td>
                            <td><?php echo $row['nome']; ?></td> 
                            <td><?php echo $row['descricao']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } ?>

<?php if($agendamentosCancelados -> rowCount() > 0) {?>
<div class="card shadow mb-4">
    <div class="card-header justify-content-between align-items-center d-flex">
        <h6 id="titletable" class="m-0">Agendamentos Cancelados</h6>
    </div>
    <div class="card-body">
        <div class="tableAdmin table-responsive">
            <table class="table table-sm table-bordered" id="dataTable2" width="100%" cellspacing="0">
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
                            <td><?php echo date("d/m/Y - H:i", strtotime($row['data_hora'])) ; ?></td>
                            <td><?php echo $row['nome']; ?></td> 
                            <td><?php echo $row['descricao']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
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


<script>
    $(document).ready(function() {
    var table = $('#dataTable, #dataTable1, #dataTable2').DataTable({
        responsive: true,
        "language": {
            "lengthMenu": "Mostrar _MENU_",
            "zeroRecords": "Nada Encontrado : (",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(de um total de _MAX_ registros)",
            "sSearch": "Pesquisar:",
            "oPaginate": {
                "sPrevious": "Anterior",
                "sNext": "Próxima"
            }
        },
    });
});
</script>