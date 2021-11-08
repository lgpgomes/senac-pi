<?php
require_once '../../banco/banco.php';
require_once '../../usuario/usuario.php';
require_once '../util/connection.php';
?>

<?php if($tipo == 0) { ?>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popupFuncionario">
        Cadastrar Funcionário
    </button>
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#popupServico">
        Cadastrar Serviço
    </button>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#popupCliente">
        Cadastrar Cliente
    </button>
                        
<?php } ?>


<?php if($tipo == 1 || $tipo == 2) { ?>
<div class="row" style="color: <?php echo $color?> !important">
    <div class="col col-md-4 mb-4">
        <div class="card shadow" style="border-left: 0.25rem solid;  border-color: <?php echo $color?>;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0"><?php echo $agendamentosPendentes -> rowCount() ?></div>
                        <div class="p mb-1"> Agendamentos Pendentes </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-calendar fa-2x "></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-md-4 mb-4">
        <div class="card shadow" style="border-left: 0.25rem solid;  border-color: <?php echo $color?>;">
            <div class="card-body">
                <div class="row  align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0"><?php echo $agendamentosConcluidos -> rowCount() ?></div>
                        <div class="p mb-1"> Agendamentos Concluídos</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-calendar fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-md-4 mb-4">
        <div class="card shadow" style="border-left: 0.25rem solid;  border-color: <?php echo $color?>;">
            <div class="card-body">
                <div class="row  align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0"><?php echo $agendamentosCancelados -> rowCount() ?></div>
                        <div class="p mb-1"> Agendamentos Cancelados</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-calendar fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>


