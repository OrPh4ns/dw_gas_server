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
            <li class="nav-item"><a class="nav-link active" href="index.php">Startseite</a></li>
            <li class="nav-item"><a class="nav-link" href="auswertung.php">Auswertung</a></li>
            <li class="nav-item"><a class="nav-link" href="graf1.php">Grafische Auswertung 1</a></li>
            <li class="nav-item"><a class="nav-link" href="graf2.php">Grafische Auswertung 2</a></li>
        </ul>
    </div>
    <div style="text-align: center;"><img src="assets/img/FB05_GES.svg"
                                          style="min-width: 270px;width: 309px;height: 81px;margin-right: 0;padding-top: 0;">
    </div>
    <div style="text-align: center;"><img src="assets/img/1%204LlOSLLo9CEZ4T3xVnxKKg.png"></div>
    <div class="card-body">
        <h4 class="card-title" style="text-align: center;border-color: rgb(226, 79, 67);color: rgb(13,147,10);">GAS DATA
            WAREHOUSE</h4>
        <p class="card-text" style="text-align: center;">Dieses Projekt wurde im Rahmen des Moduls Datawarehouse
            entwickelt und soll eine Sammlung von Daten, wie Informationen und Historie der Gaspreise durfchführen. Die
            Daten werden nach der Erhebung ausgewertet und dargestellt</p>
        <div style="text-align: center;"><a class="btn btn-primary" href="auswertung.php" style="text-align: center;">Zu
                Bewertung</a></div>
        <div style="text-align: center;">
            <form  method="post">
                <button class="btn btn-primary" name="update_csv" type="submit" style="background: rgb(33,177,160);margin-top: 19px;">CSV
                    Städe List Aktulisieren
                </button>
                <?php
                if(isset($_POST['update_csv']))
                {
                    include "classes/DB.php";
                    include "classes/Addresses.php";
                    $ad = new Addresses();
                    if($ad->insertAddressesFromCsv())
                    {
                        echo '<p class="mt-3 text-success">Erfolgreiche Aktion</p>';
                    }
                    else
                    {
                        echo '<p class="mt-3 text-danger">Fehler aufgetreten</p>';
                    }
                }
                ?>
            </form>
        </div>
        <div style="margin-top: 40px;border-top-width: 1px;border-top-style: solid;">
            <h4 style="text-align: center;border-color: rgb(226, 79, 67);color: rgb(13,147,10);margin-top: 11px;">
                Hilfestellung</h4>
            <p>Um das Projekt starten zu können, müssen Sie den Ordner des Projektes in der Konsole öffnen.</p>
            <p>Beispiel beim Windows Server mit der XAMPP Anwendung -&gt; C:\www\htdocs\PROJEKT_NAME\</p>
            <p>Verwenden Sie die unteren Befehle, um das Programm zu starten</p>
            <p>1 - cd C:\www\htdocs\PROJEKT_NAME\</p>
            <p>2 - php task_runner.php um die Erhebung durchzuführen</p>
            <p>3 - CTRL + C um Prozess abzubrechen</p>
            <p>4 - Um die Darstellung Auswertung zu zeigen, klicken Sie oben auf "Zu Bewertung"</p>
            <p>5 - Wenn Sie neue Städte einfügen möchten, fügen Sie die in die stadt.csv Datei und klichen Sie bitte
                oben auf "CSV Städe List Aktulisieren"</p>
            <p>6 - Viel Erfolg ^_^</p>
        </div>
    </div>
</div>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>