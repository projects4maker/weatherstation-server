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
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>
        <script>
            var site = {
                name:"Dashboard",
                hash:"<?=$hash?>",
                sub_path:"<?=$root?>",
                charts: null,
                cron: {}
            }
        </script>
    </head>
    <body>
        <nav id="dashboard-head">
            <div class="headline-section">
                <img class="img" src="<?=$root?>dist/img/cloud-white-18dp.svg">
                <span class="text">Weatherstation Dashboard</span>
            </div>
            <div class="user-section">
                <div class="info-tab">
                    <span class="status-pill badge badge-pill badge-secondary">Unknown</span>
                    <span class="status-text">Status unknown.</span>
                </div>
                <div class="seperator">|</div>
                <div class="form-container">
                    <button id="logout" type="button" class="btn btn-primary btn-sm">Log out</button>
                </div>
            </div>
        </nav>
        <main id="dashboard">
            <div class="chart">
                <canvas id="myChart" width="50" height="400"></canvas>
            </div>
        </main>
        <footer id="status-bar">
            <div class="value-container">
                <div class="value" id="humidity">
                    <img class="img" src="<?=$root?>dist/img/brightness_7-white-18dp.svg">
                    <span class="text">27 H</span>
                </div>
                <div class="value" id="temperature">
                    <img class="img" src="<?=$root?>dist/img/ac_unit-white-18dp.svg">
                    <span class="text">26.3 &deg;C</span>
                </div>
                <div class="value" id="pressure">
                    <img class="img" src="<?=$root?>dist/img/close_fullscreen-white-18dp.svg">
                    <span class="text">1012 mbar</span>
                </div>
            </div>
        </footer>
        <script src="<?=$root?>dist/js/latest.min.js"></script>
        <script>
            $(document).ready(function(e){
                site.charts = null;
                site.data = null;
                site.last = null;

                setInterval(cron(), 10000);
            });
        </script>
    </body>
</html>