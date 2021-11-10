
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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