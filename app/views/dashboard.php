<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

$root = App\WeatherStationService::get('sub_path');
$hash = App\WeatherStationService::get('weather_station_very_hash');
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>Dashboard | Weatherstation Dashboard</title>
        <link rel="stylesheet" href="<?=$root?>dist/css/latest.min.css">
        <link rel="icon" href="<?=$root?>dist/img/cloud_circle-24px.svg" type="image/x-icon">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            var site = {
                name:"Dashboard",
                hash:"<?=$hash?>",
                sub_path:"<?=$root?>"
            }
        </script>
    </head>
    <body>
        <nav id="dashboard-head">
            <div class="headline-section">
                <img class="img" src="<?=$root?>dist/img/cloud-white-18dp.svg">
                <span class="text">Weatherstation Dashboard</span>
            </div>
            <div class="head-cli">
                <div class="inner-cli">
                    <span>Loading..</span>
                </div>
            </div>
            <div class="form-container">
                <button id="logout" type="button" class="btn btn-primary btn-sm">Log out</button>
            </div>
            <div class="info-tab">
                <span class="status-pill badge badge-pill badge-danger">Outdated</span>
                <span class="status-text">Last value received at <strong>20.20.1212</strong></span>
            </div>
        </nav>
        <main id="dashboard">

        </main>
        <footer id="status-bar"></footer>
        <script src="<?=$root?>dist/js/latest.min.js"></script>
    </body>
</html>