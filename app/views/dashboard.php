<?php
$root = App\WeatherStationService::get('sub_path');
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>Dashboard | Weatherstation Dashboard</title>
        <link rel="stylesheet" href="<?=$root?>dist/css/latest.min.css">
        <link rel="icon" href="<?=$root?>dist/img/cloud_circle-24px.svg" type="image/x-icon">
        <script src="<?=$root?>dist/js/latest.min.js"></script>
    </head>
    <body>
        <nav id="dashboard-head">
            <div class="headline-section">
                <img class="img" src="<?=$root?>dist/img/cloud-white-18dp.svg">
                <span class="text">Weatherstation Dashboard</span>
            </div>
            <div class="info-tab">
                <button type="button" class="btn btn-primary btn-sm">Log out</button>
                <span class="seperator"> | </span>
                <span class="status-pill badge badge-pill badge-danger">Outdated</span>
                <span class="status-text">Last value received at <strong>20.20.1212</strong></span>
            </div>
        </nav>
        <main id="dashboard">

        </main>
        <footer id="status-bar"></footer>
    </body>
</html>