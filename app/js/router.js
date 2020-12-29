/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function router() {

    let object = window.location.hash.split("!")[0].substring(1);

    var options = {};

    if(object == "") {

        object = "live";
    }

    switch(object) {

        case 'live':
            options = routes.live;


            break;
        case 'h-comp':
            options = routes.h_comp;
            break;
    }

    //Set object
    site.route = options;
    
    //Nav
    $(".list-element a").removeClass("active");
    $(".list-element a[href$='" + object + "']").addClass("active");
    
    //Design Model
    model(options);

    //Update the current chart
    updateCurrentChart();

}