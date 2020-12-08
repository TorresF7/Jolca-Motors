<?php 
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
    require 'includes/templates/barra.php'; 
     require 'includes/templates/navegacion.php'; 
    
?>


<div class="content-wrapper" style="font-size:18px;font-family: 'Commissioner', sans-serif;">
    <section class="content-header">
        <div class="container-fluid">   
            <div class="col-sm-6">
                <h1 style="font-family:font-family: 'Roboto Slab', serif;">Reporte de tiempo de atención promedio</h1>
            </div>
        </div>
    </section>

    <iframe width="100%" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiODdhMDNhMDgtNGQ1NC00ODliLWI5YmEtNDQ5ZWJmZjE1YzZkIiwidCI6ImRjZjIzYjkxLTBiZTMtNDBhMy05MjI3LTg3MjYxMzkwNzJmNCJ9" frameborder="0" allowFullScreen="true"></iframe>
</div>
<?php
require 'includes/templates/footer.php'; 
?>
<script>
     $(function() {
            //---------------------
            //- STACKED BAR CHART -
            //---------------------
            // var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
            // var stackedBarChartData = jQuery.extend(true, {}, barChartData)

            // var stackedBarChartOptions = {
            //     responsive: true,
            //     maintainAspectRatio: false,
            //     scales: {
            //         xAxes: [{
            //             stacked: true,
            //         }],
            //         yAxes: [{
            //             stacked: true
            //         }]
            //     }
            // }

            // var stackedBarChart = new Chart(stackedBarChartCanvas, {
            //     type: 'bar',
            //     data: stackedBarChartData,
            //     options: stackedBarChartOptions
            // })
 
            var ctx1 = document.getElementById('myChart2').getContext('2d');
            var chart = new Chart(ctx1, {
                type: 'bar',

                data:{
                    labels: <?php echo json_encode($Meses);?>,
                    datasets:[{
                        label: 'promedio',
                        backgroundColor:"#428EB4",
                        data:<?php echo json_encode($cantidad); ?>, 
                    }]
                    
                }

            });

        })
</script>

