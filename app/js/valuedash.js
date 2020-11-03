/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function valuedash(values, display=1) {

    let container = '#status-bar .value-container';

    if(display == 1) {

        $(container).fadeIn("fast");
    } else {

        $(container).fadeOut("fast");
    }

    $(container + ' #humidity .text .parsed-value').html(values.humidity);
    $(container + ' #temperature .text .parsed-value').html(values.temperature);
    $(container + ' #pressure .text .parsed-value').html(values.pressure);
}