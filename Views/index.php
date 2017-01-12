<!DOCTYPE html>
<html lang="zh">
<head>
    <title>online-statistics</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/Chart.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <h1 class="text-muted page-header">在线统计</h1>
        <table class="table table-bordered table-striped table-hover text-center">
            <tr>
                <td>#</td>
                <td>文件</td>
                <td>类型</td>
                <td>阅读&观看次数</td>
                <td>阅读&观看时间</td>
                <td>下载量</td>
                <td>操作</td>

            </tr>
            <?php
            foreach ($files as $file) {
                echo '<tr>';
                echo '<td>' . $file->id . '</td>';
                echo '<td>' . $file->name . '</td>';
                echo '<td>' . $file->type . '</td>';
                echo '<td>' . $file->read_count . '次</td>';
                echo '<td>' . $file->read_time . '秒</td>';
                echo '<td>' . $file->download . '次</td>';
                echo '<td style="width: 180px">';
                if ($file->type == 'video') {
                    echo '
                    <a class="btn btn-success pull-left" href="/video?id=' . $file->id . '" target="_black">在线观看</a>';
                } else {
                    echo '
                    <a class="btn btn-success pull-left" href="/read?id=' . $file->id . '" target="_black">阅读</a>';
                }
                echo '<a class="btn btn-primary pull-right" href="/download?id=' . $file->id . '">下载</a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
    <div class="row">
        <div class="col-md-6">
            <canvas id="downloadChart" width="200" height="100"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="readChart" width="200" height="100"></canvas>
        </div>
    </div>
</div>
</body>

<script>
    var download = document.getElementById("downloadChart");
    var downloadChart = new Chart(download, {
        type: 'bar',
        data: {
            labels: [<?php foreach ($files as $file) echo '"'.$file->name . '",' ?>],
            datasets: [{
                label: '下载量',
                data: [<?php foreach ($files as $file) echo $file->download . ',' ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctx = document.getElementById("readChart");
    var readChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php foreach ($files as $file) echo '"'.$file->name . '",' ?>],
            datasets: [{
                label: '阅读&观看次数',
                data: [<?php foreach ($files as $file) echo $file->read_count . ',' ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

</html>