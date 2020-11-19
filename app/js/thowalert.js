/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function throwalert(msg, level=0) {

    id = "a-" + Date.now();

    let area = '.alert-area';

    if($(area + ' .alert').length > 7) {

        $(area + ' .alert').last().remove();
    }

    if(level == 2) {

        cls = "danger";
        type = "Error";
    } else if(level == 1) {

        cls = "warning";
        type = "Warning";
    } else if(level == 0) {

        cls = "secondary";
        type = "Notice";
    }

    if(msg.length > 70) {

        msg = msg.substring(0, 67) + "...";
    }

    $(area).append(
        "<div id=\"" + id + "\" class=\"alert alert-dismissible alert-" + cls + "\">\
            <button type=\"button\" class=\"close\">&times;</button>\
            <strong>" + type + ":</strong> " + msg + "\
        </div>"
    );

    $("#" + id).delay(2400).fadeOut();

    $('#' + id + ' .close').click(function(e) {

        $(this).parent().fadeOut();
    });
}