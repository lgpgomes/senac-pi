<?php
require_once '../../banco/banco.php';
require_once '../../usuario/usuario.php';
require_once '../util/connection.php';

$todosFuncionarios = obterUsuarios(TIPO_USUARIO_FUNCIONARIO, null);
?>
<?php if ($tipo == 0) {?>
<div class="card ">
    <div class="card-header px-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="card-head">
                <h5 class="card-title mb-0 py-1" style="color: <?php echo $color;?>">Funcionários</h5>
            </div>
            <div class="d-flex">
                <button type="button" class="btncadcliente btn btn-sm" style="color: <?php echo $color;?>" data-bs-toggle="modal" data-bs-target="#popupFuncionario"><i class="icon-plus fa fa-plus"></i> </button>
            </div>
        </div>
    </div>
    <div class="card-body p-4">
        <div class="container-table">
            <table class="table table-hover">
                <thead>
                    <tr id="tr">
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Senha</th>
                        <th>Tipo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($todosFuncionarios as $row) {?>
                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['NOME']; ?></td> 
                        <td><?php echo $row['EMAIL']; ?></td>
                        <td><?php echo $row['SENHA']; ?></td>
                        <td><?php echo $row['TIPO']; ?></td>
                        <td><?php echo $row['STATUS']; ?></td>
                        <td>
                            <button type="button" onclick="btnfunc(this)" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i> <span class="hidden-xl">Editar</span></button>
                            <?php if($row['STATUS'] == 1) {?>
                            <button onclick="statusUser(<?php echo $row['ID']; ?>, <?php echo $row['STATUS']; ?>, './pages/funcionarios.php')" type="button"  class="btn btn-secondary btn-sm"><i class="fa fa-user-times"></i> Desativar</button>
                            <?php } ?>
                            <?php if($row['STATUS'] == 0) {?>
                            <button onclick="statusUser(<?php echo $row['ID']; ?>, <?php echo $row['STATUS']; ?>, './pages/funcionarios.php')"  type="button" class="btn btn-secondary btn-sm"><i class="fa fa-user-plus"></i> Ativar</button>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php } ?>