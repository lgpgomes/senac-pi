<?php
require_once '../../banco/banco.php';
require_once '../../usuario/usuario.php';
require_once '../util/connection.php';
?>

<p class="h5">Funcionários</p>
<table class="table table-sm table-striped table-hover">
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
        <?php foreach($funcionarios as $row) {?>
        <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['NOME']; ?></td> 
            <td><?php echo $row['EMAIL']; ?></td>
            <td><?php echo $row['SENHA']; ?></td>
            <td><?php echo $row['TIPO']; ?></td>
            <td><?php echo $row['STATUS']; ?></td>
            <td>
                <button type="button" onclick="btnfunc(this)" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i> Editar</button>
                <?php if($row['STATUS'] == 1) {?>
                <button type="button" class="btn btn-secondary btn-sm"><i class="fa fa-user-times"></i> Desativar</button>
                <?php } ?>
                <?php if($row['STATUS'] == 0) {?>
                <button type="button" class="btn btn-secondary btn-sm"><i class="fa fa-user-plus"></i> Ativar</button>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>