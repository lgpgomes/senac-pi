<?php
require_once '../../banco/banco.php';
require_once '../../usuario/usuario.php';
require_once '../util/connection.php';
?>


<?php if($tipo == 0) { ?>

<div class="row" style="color: <?php echo $color?> !important">
    <div class="col col-md-4 mb-4">
        <div class="card shadow" style="border-left: 0.25rem solid;  border-color: <?php echo $color?>;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0"><?php echo $funcionarios -> rowCount() ?></div>
                        <div class="p mb-1"> Funcionários Cadastrados </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-suitcase fa-2x "></i>
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
                        <div class="h5 mb-0"><?php echo $clientes -> rowCount() ?></div>
                        <div class="p mb-1"> Clientes Cadastrados </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-users fa-2x"></i>
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
                        <div class="h5 mb-0"><?php echo $servicos -> rowCount() ?></div>
                        <div class="p mb-1"> Serviços Cadastrados </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-clipboard fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="piechart"></div>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Serviço', 'Ocorrências'],
          <?php foreach($charts as $row) {?>
          ['<?php echo $row['DESCRICAO'] ?>', <?php echo $row['Total_Sevicos']?>],
          <?php }?>
        ]);


        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        var options = {
            title: 'Serviços Mais Utilizados',
            backgroundColor: '#E4E4E4',
            is3D: false,
            width:1100,
            height:400
        };
        chart.draw(data, options);
      }
    </script>
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


