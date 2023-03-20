<?php
spl_autoload_register(function ($className) {
    include 'classes/' . $className . '.php';
});

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>DW_Mockup</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Serif">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
</head>

<body>
<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link" href="index.php">Startseite</a></li>
            <li class="nav-item"><a class="nav-link" href="auswertung.php">Auswertung</a></li>
            <li class="nav-item"><a class="nav-link" href="graf1.php">Grafische Auswertung 1</a></li>
            <li class="nav-item"><a class="nav-link active" href="graf2.php">Grafische Auswertung 2</a></li>
        </ul>
    </div>
    <div style="text-align: center;"><img src="assets/img/FB05_GES.svg"
                                          style="min-width: 270px;width: 309px;height: 81px;margin-right: 0;padding-top: 0;">
    </div>
    <div style="text-align: center;"><img src="assets/img/1%204LlOSLLo9CEZ4T3xVnxKKg.png"></div>
    <div class="card-body">
        <div id="nav-tabContent" class="tab-content">
            <div id="item-1-1" class="tab-pane fade show active" role="tabpanel" aria-labelledby="item-1-1-tab">
                <h4 style="text-align: center;color: rgb(13,147,10);">GAS DATA WAREHOUSE</h4>
                <div style="text-align: center;"></div>
            </div>
        </div>


            <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
            <script type="text/javascript">
                window.onload = function () {
                    var dataPoints = [];
                    var chart = new CanvasJS.Chart("chartContainer",{
                        title:{
                            text:"Petrol Station Avg prices"
                        },
                        data: [{
                            type: "line",
                            dataPoints : dataPoints,
                        }]
                    });
                    $.getJSON("api.php?graf=2", function(data) {
                        for (let i = 0 ; i < data.length; i++)
                        {
                            console.log(parseFloat(data[i]));
                            dataPoints.push({x: i, y: parseFloat(data[i])});
                        }
                        chart.render();
                    });
                }
            </script>

        <div id="chartContainer" style="height: 300px; width: 100%;"></div>













    </div>
</div>



<script>


</script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>