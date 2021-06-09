/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
$("#toggle-updated").click(function (e) {

    if ($(this).value) {

        setupCron();
        $(this).value = 0;
    } else {

        killCron();
        $(this).value = 1;
    }

});

function setupCron() {

    cron();
    site.cron = setInterval(cron, 9000);
}

function killCron() {

    clearInterval(site.cron)
    statusbar("", 0);
}