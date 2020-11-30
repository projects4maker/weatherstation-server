/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function logout() {
    $("#logout").prop("disabled", true);

    let result = $.post(site.sub_path + "ajax/logout", {});

    result.done(function(d) {
        
        if (d.status == "ok" &&
            d.data.logout == "ok") {

            window.location.href = site.sub_path + "login";
        } else if (d.status == "ok" &&
            d.data.logout == "failed") {

                throwalert("Logout request failed",2);
        } else {

            throwalert("Logout request rejected",2);
        }
    });

    result.fail(function() {

        throwalert("Logout request failed",2);
    });

    $("#logout").prop("disabled", false);
}

$("#logout").click(function(e) {

    e.preventDefault();
    logout();

});

