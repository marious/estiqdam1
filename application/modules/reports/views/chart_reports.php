<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
</head>
<body>
<div class="report-type">
    <?php
    function make_selected($input_name, $value)
    {
        if (isset($_REQUEST[$input_name]) && $_REQUEST[$input_name] == $value) {return 'selected';}
        return '';
    }
    ?>
    <form action="" method="get">
        <select name="chart_type" id="" onchange="this.form.submit()">
            <option value="num_of_contracts" <?= make_selected('chart_type', 'num_of_contracts'); ?>>عدد العقود الشهرية</option>
            <option value="num_of_workers" <?= make_selected('chart_type', 'num_of_workers') ?>>عدد العاملين</option>
        </select>
    </form>
</div>
<canvas id="myChart" width="400" height="200"></canvas>

<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونيه", "يولويو", 'اغسطس', "سبتمبر", "اكتوبر", "نوفمبر", "ديسمبر"],
            datasets: [{
                label: '<?= $chart_title; ?>',
                data: <?= $chart_data ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        stepSize: 3
                    }
                }]
            }
        }
    });
</script>

</body>
</html>