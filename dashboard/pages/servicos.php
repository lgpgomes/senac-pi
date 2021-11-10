<?php
require_once '../../banco/banco.php';
require_once '../../usuario/usuario.php';
require_once '../util/connection.php';
?>

<div class="row">
    <div class="col-auto">
        <p class="h5">Serviços</p>
    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#popupServico">
            Cadastrar Serviço
        </button>
    </div>
</div>
<table class="table table-sm table-striped table-hover">
    <thead>
        <tr id="tr">
            <th>Id</th>
            <th>Descrição</th>
            <th>Imagem</th>
            <th>Icone</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($servicos as $row) {?>
        <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['DESCRICAO']; ?></td> 
            <td><?php echo $row['IMAGEM']; ?></td>
            <td><?php echo $row['ICONE']; ?></td>
            <td><?php echo $row['STATUS']; ?></td>
            <td>
                <button type="button" onclick="btnserv(this)" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i> Editar</button>
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
