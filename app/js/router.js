/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function router() {

    let object = window.location.hash.split("!")[0];

    if(object == "") {

        object = "live";
    }

    switch(object) {

        case 'live':



        case 'test':
    }

    //Design Model
    model(options);

    return null;

}