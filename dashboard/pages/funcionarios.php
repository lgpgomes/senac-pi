<?php
require_once '../../banco/banco.php';
require_once '../../usuario/usuario.php';
require_once '../util/connection.php';

$todosFuncionarios = obterUsuarios(TIPO_USUARIO_FUNCIONARIO, null);
?>
<?php if ($tipo == 0) {?>
<!-- Tabela Funcionários -->
<div class="card shadow mb-4">
    <div class="card-header justify-content-between align-items-center d-flex">
        <h6 id="titletable" class="m-0">Funcionários</h6>
        <button type="button" class="btn btn-outline-secondary btn-sm btncad-table" data-bs-toggle="modal" data-bs-target="#popupFuncionario"><i class="icon-plus fa fa-plus"></i> </button>
    </div>
    <div class="card-body">
        <div class="tableAdmin table-responsive">
            <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Senha</th>
                        <th>Status</th>          
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($todosFuncionarios as $row) {?>
                        <tr>
                            <td><?php echo $row['ID']; ?></td>
                            <td><?php echo $row['NOME']; ?></td> 
                            <td><?php echo $row['EMAIL']; ?></td>
                            <td><?php echo $row['SENHA']; ?></td>
                            <td><?php echo $row['STATUS']; ?></td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn btn-outline-secondary" onclick="btnfunc(this)" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-edit"></i>
                                        <span class="d-none d-xl-inline">Editar</span>
                                    </button>
                                    <?php if($row['STATUS'] == 1) {?>
                                        <button type="button" class="btn btn-outline-secondary" onclick="statusUser(<?php echo $row['ID']; ?>, <?php echo $row['STATUS']; ?>, './pages/funcionarios.php')"> 
                                        <i class="fa fa-user-times"></i>     
                                        <span class="d-none d-xl-inline">Desativar</span>
                                        </button>
                                    <?php } if($row['STATUS'] == 0) { ?>
                                        <button type="button" class="btn btn-outline-secondary" onclick="statusUser(<?php echo $row['ID']; ?>, <?php echo $row['STATUS']; ?>, './pages/funcionarios.php')">
                                        <span class="fa fa-user-plus"></span> 
                                        <span class="d-none d-xl-inline">Ativar</span>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    var table = $('#dataTable').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ linhas por página",
            "zeroRecords": "Nada Encontrado : (",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(de um total de _MAX_ registros)",
            "sSearch": "Pesquisar:",
            "oPaginate": {
                "sPrevious": "Anterior",
                "sNext": "Próxima"
            }
        }
    });
});
</script>
<?php } ?>


