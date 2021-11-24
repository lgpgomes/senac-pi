<?php
require_once '../../banco/banco.php';
require_once '../../usuario/usuario.php';
require_once '../util/connection.php';
?>

<!--Home Administrador-->
<?php if($tipo == 0) {
$todosFuncionarios = obterUsuarios(TIPO_USUARIO_FUNCIONARIO, null);
$todosClientes = obterUsuarios(TIPO_USUARIO_CLIENTE, null);
$servicos = obterServicos(null);    
?>
<!--Cards-->
<div class="row mb-4 gx-2 gy-2" style="color: <?php echo $color?> !important">
    <div class="col">
        <div class="card shadow" style="border-left: 0.2rem solid;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-1"><?php echo $todosFuncionarios -> rowCount() ?></div>
                        <div class="p mb-1"> Funcionários Cadastrados </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-suitcase fa-2x "></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow" style="border-left: 0.2rem solid;">
            <div class="card-body">
                <div class="row  align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-1"><?php echo $todosClientes -> rowCount() ?></div>
                        <div class="p mb-1"> Clientes Cadastrados</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow" style="border-left: 0.2rem solid;">
            <div class="card-body">
                <div class="row  align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-1"><?php echo $servicos -> rowCount() ?></div>
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
<!--Gráficos-->
<div class="row gx-2 gy-2">
    <div class="col-xl-8 col-lg-7 ">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="chart-line-title m-0" style="color:<?php echo $color;?>">Agendamentos Por Dia</h6>

            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myChart" width="500" ></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="chart-line-title m-0" style="color:<?php echo $color;?>"> Serviços Mais utilizados</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie">
                    <canvas id="myPieChart" width="500"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$domingo = 0;
$segunda = 0;
$terca = 0;
$quarta = 0;
$quinta = 0;
$sexta = 0;
$sabado = 0;

foreach (chartLine()  as $row) {
    if ($row['DAYOFWEEK(DATA_HORA)'] == 1) {
        $domingo = $row['ocorrencias'];
    }
    if ($row['DAYOFWEEK(DATA_HORA)'] == 2) {
        $segunda = $row['ocorrencias'];
    }
    if ($row['DAYOFWEEK(DATA_HORA)'] == 3) {
        $terca = $row['ocorrencias'];
    }
    if ($row['DAYOFWEEK(DATA_HORA)'] == 4) {
        $quarta = $row['ocorrencias'];
    }
    if ($row['DAYOFWEEK(DATA_HORA)'] == 5) {
        $quinta = $row['ocorrencias'];
    }
    if ($row['DAYOFWEEK(DATA_HORA)'] == 6) {
        $sexta = $row['ocorrencias'];
    }
    if ($row['DAYOFWEEK(DATA_HORA)'] == 7) {
        $sabado = $row['ocorrencias'];
    }
}
?>

<script>
var ctx = document.getElementById("myChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [
        "Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado",
    ],
    datasets: [{
      label: "",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "#17477F",
      pointRadius: 3,
      pointBackgroundColor: "#17477F",
      pointBorderColor: "#17477F",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "#17477F",
      pointHoverBorderColor: "#17477F",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [<?php echo $domingo.','; echo $segunda.','; echo $terca.','; echo $quarta.','; echo $quinta.','; echo $sexta.','; echo $sabado; ?>],
    }],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          beginAtZero: true
        },
      }],
    },
    legend: {
      display: false
    },
  }
});

var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: [
        <?php foreach(chartPie() as $row) {?>
            "<?php echo $row['DESCRICAO'] ?>",
        <?php }?>
    ],
    datasets: [{
      data: [
        <?php foreach(chartPie() as $row) {?>
          [<?php echo $row['qtd']?>],
          <?php }?>
      ],
      backgroundColor: ['#17477F', '#3E89DE', '#519DF5', '#3E89DE', '#469AFA'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    cutoutPercentage: 0,
  },
});
</script>
<?php } ?>

<!--Home Funcionario e Cliente-->
<?php if($tipo == 1 || $tipo == 2) {
$agendamentosPendentes = obterAgendamentos($usuario -> get_id(), $tipo, STATUS_AGENDAMENTO_PENDENTE);
$agendamentosCancelados = obterAgendamentos($usuario -> get_id(), $tipo, STATUS_AGENDAMENTO_CANCELADO);
$agendamentosConcluidos = obterAgendamentos($usuario -> get_id(), $tipo, STATUS_AGENDAMENTO_CONCLUIDO);
?>
<div class="row mb-4 gx-2 gy-2" style="color: <?php echo $color?> !important">
    <div class="col">
        <div class="card shadow" style="border-left: 0.2rem solid;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                    <div class="h5 mb-1"><?php echo $agendamentosPendentes -> rowCount() ?></div>
                        <div class="p mb-1"> Agendamentos Pendentes </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-calendar fa-2x "></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow" style="border-left: 0.2rem solid;">
            <div class="card-body">
                <div class="row  align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-1"><?php echo $agendamentosConcluidos -> rowCount() ?></div>
                        <div class="p mb-1"> Agendamentos Concluídos</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-calendar fa-2x "></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow" style="border-left: 0.2rem solid;">
            <div class="card-body">
                <div class="row  align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-1"><?php echo $agendamentosCancelados -> rowCount() ?></div>
                        <div class="p mb-1"> Agendamentos Cancelados </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-calendar fa-2x "></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!--Home Funcionario-->
<?php if($tipo == 1) {?>
<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-7 ">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="chart-line-title m-0" style="color:<?php echo $color;?>">Agendamentos Por Mês</h6>

            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myBarChart" width="500" ></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
var ctx = document.getElementById("myBarChart");
var myPieChart = new Chart(ctx, {
    type: 'bar',
  data: {
    labels: [
        <?php 
            foreach (chartBar($id) as $row) {
                if($row['mes'] == 1) {
                    echo 'Janeiro,';
                } 
                else if ($row['mes'] == 2) {
                    echo '"Fevereiro",';
                }
                else if ($row['mes'] == 3) {
                    echo '"Março",';
                }
                else if ($row['mes'] == 4) {
                    echo '"Abril",';
                }
                else if ($row['mes'] == 5) {
                    echo '"Maio",';
                }
                else if ($row['mes'] == 6) {
                    echo '"Junho",';
                }
                else if ($row['mes'] == 7) {
                    echo '"Julho",';
                }
                else if ($row['mes'] == 8) {
                    echo '"Agosto",';
                }
                else if ($row['mes'] == 9) {
                    echo '"Setembro",';
                }
                else if ($row['mes'] == 10) {
                    echo '"Outubro",';
                }
                else if ($row['mes'] == 11) {
                    echo '"Novembro",';
                }
                else if ($row['mes'] == 12) {
                    echo '"Dezembro",';
                }
            }
        ?>
    ],
    datasets: [{
      data: [
        <?php foreach(chartBar($id) as $row) {?>
          [<?php echo $row['ocorrencias']?>],
          <?php }?>
      ],
      backgroundColor: ['#17477F', '#3E89DE', '#519DF5', '#3E89DE', '#469AFA'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }],
        xAxes: [{
            barPercentage: 0.2
        }]
    }
  },
});
</script>
<?php } ?>

<!--Home Cliente-->
<?php if($tipo == 2) {

$agendamentosPendentes = obterAgendamentos($id, $tipo, STATUS_AGENDAMENTO_PENDENTE);

?>
<?php if($agendamentosPendentes -> rowCount() > 0) {?>
<div class="card shadow mb-4">
    <div class="card-header justify-content-between align-items-center d-flex">
        <h6 id="titletable" class="m-0">Agendamentos Pendentes</h6>
    </div>
    <div class="card-body">
        <div class="tableCliente table-responsive">
            <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Profissional</th>
                        <th>Serviço</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($agendamentosPendentes as $row) {?>
                        <tr>
                            <td><?php echo $row['data_hora']; ?></td>
                            <td><?php echo $row['nome']; ?></td> 
                            <td><?php echo $row['descricao']; ?></td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="agendavazia d-flex justify-content-center align-items-center" style="height: 50vh">
    <div class="row">
        <div class="col">
            <?php if ($tipo == 2) { ?>
                <p class="h4"> Você não tem nenhum agendamento pendente... </p>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#popupAgendamento">
                    Fazer Agendamento!
                </button>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
<?php } ?>



