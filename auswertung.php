<?php
spl_autoload_register(function ($className)
{
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
            <li class="nav-item"><a class="nav-link active" href="auswertung.php">Auswertung</a></li>
            <li class="nav-item"><a class="nav-link" href="graf1.php">Grafische Auswertung 1</a></li>
            <li class="nav-item"><a class="nav-link" href="graf2.php">Grafische Auswertung 2</a></li>
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
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">E-10</h1>
                                <h4 style="font-size: 21px;color: rgb(13,147,10);">Preis am günstigsten</h4>

                                <span class="price" style="font-weight: bold;">
                                    <?php
                                        $infos = Statistics::getCheapPriceInfoE10()[0];
                                    ?>
                                    Preis = <?php echo $infos[0]; ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">E-5</h1>
                                <h4 style="font-size: 21px;color: rgb(13,147,10);">Preis am günstigsten<br></h4>
                                <span class="price" style="font-weight: bold;">
                                    <?php
                                    $infos = Statistics::getCheapPriceInfoE5();
                                    //var_dump($infos);
                                    ?>
                                    Preis = <?php echo $infos[0]; ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Diesel</h1>
                                <h4 style="font-size: 21px;color: rgb(13,147,10);">Preis am günstigsten<br></h4>
                                <span class="price" style="font-weight: bold;">
                                    <?php
                                    $infos = Statistics::getCheapPriceInfoDiesel();
                                    ?>
                                    Preis = <?php echo $infos[0]; ?>
                                </span>
                            </li>
                        </ul>
                    </div>


                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Durchschnittlicher Preis</h1>
                                <h4 style="color: var(--bs-green);">E10</h4>
                                <span class="price" style="font-weight: bold;">
                                    <?php echo substr(Statistics::getAVGE10()[0], 0,4);?>€
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Durchschnittlicher Preis</h1>
                                <h4 style="color: var(--bs-green);">E5</h4>
                                <span class="price" style="font-weight: bold;">
                                    <?php echo substr(Statistics::getAVGE5()[0], 0,4);?>€
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Durchschnittlicher Preis</h1>
                                <h4 style="color: var(--bs-green);">Diesel</h4>
                                <span class="price" style="font-weight: bold;">
                                    <?php echo substr(Statistics::getAVGDiesel()[0], 0,4);?>€
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Günstigster Preis Heute(E5)</h1>
                                <span class="price" style="font-weight: bold;">
                                    <?php echo substr(Statistics::getMinTodayE5()[0], 0,4);?>€
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Günstigster Preis Heute(E10)<br></h1><span
                                        class="price" style="font-weight: bold;"><?php echo substr(Statistics::getAVGE10()[0], 0,4);?>€</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Günstigster Preis Heute(Diesel)<br></h1>
<span class="price"
                                     style="font-weight: bold;"><?php echo substr(Statistics::getAVGDiesel()[0], 0,4);?>€</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Teuerster&nbsp;Preis Heute(E10)<br></h1>
                                <span class="price" style="font-weight: bold;"><?php echo substr(Statistics::getMaxTodayE10()[0], 0,4);?>€</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Teuerster Preis Heute(E5)<br></h1><span
                                        class="price" style="font-weight: bold;"><?php echo substr(Statistics::getMaxTodayE5()[0], 0,4);?>€</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Teuerster&nbsp;Preis Heute(Diesel)<br>
                                </h1><span class="price" style="font-weight: bold;"><?php echo substr(Statistics::getMaxTodayDiesel()[0], 0,4);?>€</span>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Günstigster Gastyp</h1>
                                <span class="price" style="font-weight: bold;">
                                    <?php echo Statistics::getCheapestType()[0]?>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Teuerster Gastyp</h1>
                                <span class="price" style="font-weight: bold;">
                                    <?php echo Statistics::getExpinsiveType()[0]?>
                                </span>
                            </li>
                        </ul>
                    </div>


                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Anzahl der Erhebungen&nbsp<br></h1><span
                                        class="price" style="font-weight: bold;"><?php echo Statistics::getFactsCount()[0];?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Anzahl der aktuellen Städten<br></h1><span
                                        class="price" style="font-weight: bold;"><?php echo Statistics::getCitesCount()[0];?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Anzahl der Adressen<br></h1><span
                                        class="price" style="font-weight: bold;"><?php echo Statistics::getAddressesCount()[0];?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Anzahl der Tankstellen<br></h1><span
                                        class="price" style="font-weight: bold;"><?php echo Statistics::getStationsCount()[0];?></span>
                            </li>
                        </ul>
                    </div>

                    <!-- 24.11.2022 -->
                    <!-- Last Date -->
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Letzte Erhebung<br></h1><span
                                        <?php $date = Statistics::getLastDate(); ?>
                                        class="price" style="font-weight: bold;"><?php echo $date[0]."/"."$date[1]"."/".$date[2]."<br>".$date[3].":".$date[4];?></span>
                            </li>
                        </ul>
                    </div>

                    <!-- 20.03.2022 -->
                    <!-- First Date -->
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Erste Erhebung<br></h1><span
                                        <?php $date = Statistics::getFirstDate(); ?>
                                        class="price" style="font-weight: bold;"><?php echo $date[0]."/"."$date[1]"."/".$date[2]."<br>".$date[3].":".$date[4];?></span>
                            </li>
                        </ul>
                    </div>

                    <!-- 24.11.2022 -->
                    <!-- Last Petrol Station -->
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Letzte Erhobene Tankstelle<br></h1><span
                                        class="price" style="font-weight: bold;"><?php echo Statistics::getLastStation()[0];?></span>
                            </li>
                        </ul>
                    </div>


                    <!-- 24.11.2022 -->
                    <!-- Last Source -->
                    <div class="col-sm-4 text-center" style="margin-top: 20px;">
                        <ul class="list-group">
                            <li class="list-group-item heading">
                                <h1 style="font-size: 25px;">Letzte verwendete Quelle<br></h1><span
                                        class="price" style="font-weight: bold;"><?php echo Statistics::getLastSource()[0];?></span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>