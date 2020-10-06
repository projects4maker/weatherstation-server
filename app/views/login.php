<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

$root = App\WeatherStationService::get('sub_path');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login | Weatherstation Dashboard</title>
        <link rel="stylesheet" href="<?=$root?>dist/css/latest.min.css">
        <link rel="icon" href="<?=$root?>dist/img/cloud_circle-24px.svg" type="image/x-icon">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        </head>
    <body>
        <main id="logon-form">
            <form method="POST" action="<?=$root?>login">
              <div class="inner-form">
                  <div class="headline-section">
                      <img class="img" src="<?=$root?>dist/img/cloud-white-18dp.svg">
                      <span class="text">Weatherstation Dashboard</span>
                  </div>
                  <div class="form-group">
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Hash</span>
                          </div>
                          <input name="login_hash" type="text" class="form-control form-control-lg">
                        </div>
                      </div>
                    </div>
                  <div class="form-group">
                      <button name="try_auth" type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                  </div>
              </div>
            </form>
        </main>
        <script src="<?=$root?>dist/js/latest.min.js"></script>
    </body>
</html>