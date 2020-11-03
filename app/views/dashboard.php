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
                    <span class="status-text">Fetching latest data..</span>
                </div>
                <div class="seperator">|</div>
                <div class="form-container">
                    <button id="logout" type="button" class="btn btn-primary btn-sm">Log out</button>
                </div>
            </div>
        </nav>
        <main id="dashboard">
            <div id="sidebar">
                <ul class="list-ul">
                    <li class="list-element"><a href="#" id="tail-lc"><span class="io-icon-ding"></span> Live-Chart</a></li>
                    <li class="list-element"><a href="#"><span class="io-icon-ding"></span> Auswertung</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <div id="chart">
                <canvas id="myChart" width="100%" height="100%"></canvas>
            </div>
        </main>
        <footer id="status-bar">
            <div class="value-container">
                <div class="value" id="humidity">
                    <img class="img" src="<?=$root?>dist/img/umbrella-white-18dp.svg">
                    <span class="text"><span class="parsed-value">--</span>H</span>
                </div>
                <div class="value" id="temperature">
                    <img class="img" src="<?=$root?>dist/img/ac_unit-white-18dp.svg">
                    <span class="text"><span class="parsed-value">-.--</span>&deg;C</span>
                </div>
                <div class="value" id="pressure">
                    <img class="img" src="<?=$root?>dist/img/close_fullscreen-white-18dp.svg">
                    <span class="text"><span class="parsed-value">-.--</span>mbar</span>
                </div>
            </div>
        </footer>
        <script src="<?=$root?>dist/js/latest.min.js"></script>
        <script>
            $(document).ready(function(e){
                site.latest = {
                    data: null,
                    status: 0
                };
                
                var interval = setInterval(cron, 3000);
            });
        </script>
        <script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
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
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
    </body>
</html>