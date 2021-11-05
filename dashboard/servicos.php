<?php
require_once 'connection.php';

$pdo = obterAgendamentos($usuario -> get_id(), $tipo);
?>
<table class="table table-striped table-sm table-hover">
    <thead>
        <tr>
            <th>Data</th>
            <th>Cliente</th>
            <th>Serviço</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pdo as $row) {?>
        <tr>
            <td><?php echo $row['data_hora']; ?></td>
            <td><?php echo $row['nome']; ?></td> 
            <td><?php echo $row['descricao']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

