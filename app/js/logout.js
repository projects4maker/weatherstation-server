/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
$("#logout").click(function(e) {

    e.preventDefault();

    $(this).prop('disabled', true);

    var result = $.post(site.sub_path + 'ajax/logout', {});

    result.done(function(d) {
        
        if (d.status == 'ok' &&
            d.data.logout == 'ok') {

            window.location.href = site.sub_path + 'login';
        } else if (d.status == 'ok' &&
            d.data.logout == 'failed') {

            alert("Logout request failed.");
        } else {

            alert("Logout request rejected.");
        }
    });

    result.fail(function() {

        alert("Logout ajax request failed.");
    });

    $(this).prop('disabled', false);
});