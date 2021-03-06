<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

$root = App\WeatherStationService::get('sub_path');
$host = App\WeatherStationService::get('host');
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
                cron: {},
                latest: {
                    data: null,
                    status: 0
                }
            }
        </script>
    </head>
    <body>
        <nav id="dashboard-head">
            <div class="headline-section">
                <img class="img" src="<?=$root?>dist/img/cloud-white-18dp.svg">
                <span class="text">Weatherstation Dashboard <span class="host" title="Database server">on <?=$host?></span></span>
            </div>
            <div class="user-section">
                <div class="info-tab">
                    <span class="status-pill badge badge-pill badge-secondary">Unknown</span>
                    <span class="status-text">Fetching latest data..</span>
                </div>
                <div class="seperator">|</div>
                <div class="toggle-switch custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="toggle-updated" value="1" checked>
                    <label class="custom-control-label" for="toggle-updated">Toggle updates</label>
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
                    <li class="list-element"><a href="#live"><img class="icon" src="<?=$root?>dist/img/live_tv-white-18dp.svg"> Live-Chart</a></li>
                </ul>

                <h6>Range Charts</h6>
                <ul class="list-ul">
                    <li class="list-element"><a href="#h-comp"><img class="icon" src="<?=$root?>dist/img/umbrella-white-18dp.svg"> Humidity comparison</a></li>
                    <li class="list-element"><a href="#t-comp"><img class="icon" src="<?=$root?>dist/img/ac_unit-white-18dp.svg"> Temperature comparison</a></li>
                    <li class="list-element"><a href="#p-comp"><img class="icon" src="<?=$root?>dist/img/close_fullscreen-white-18dp.svg"> Pressure comparison</a></li>
                </ul>

                <h6>Chart Group</h6>
                <ul class="list-ul">
                    <li class="list-element"><a href="#"><img class="icon" src="<?=$root?>dist/img/live_tv-white-18dp.svg"> Live-Chart</a></li>
                    <li class="list-element"><a href="#"><img class="icon" src="<?=$root?>dist/img/equalizer-white-18dp.svg"> Data Value Chart</a></li>
                </ul>
                
                <h6>Chart Group</h6>
                <ul class="list-ul">
                    <li class="list-element"><a href="#"><img class="icon" src="<?=$root?>dist/img/live_tv-white-18dp.svg"> Live-Chart</a></li>
                    <li class="list-element"><a href="#"><img class="icon" src="<?=$root?>dist/img/equalizer-white-18dp.svg"> Data Value Chart</a></li>
                </ul>
            </div>
            <div id="content">
                <div class="header">
                    <div class="headline">
                        <span class="text">Loading</span> <small>Loading</small>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm">Export</button>
                </div>
                <div class="viewable">
                    <div class="chart-columne">
                        Loading
                    </div>
                    <div class="chart-controls">
                        Loading
                    </div>
                </div>
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
                    <span class="text"><span class="parsed-value">-.--</span>hPa</span>
                </div>
            </div>
        </footer>
        <div class="alert-area">
            <!-- do not remove this lines -->
        </div>
        <script src="<?=$root?>dist/js/latest.min.js"></script>
        <script>
            $(document).ready(function(e){
                               
                //Router
                router();

                //Interval
                setupCron();
            });
        </script>
    </body>
</html>