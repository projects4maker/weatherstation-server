/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function queryRead() {

    var params = {};
    var hash = window.location.hash;
    var queryString = hash.split("!");
    var vars = queryString[1].split("&");

    for(var i = 0; i < vars.length; i++) {

        var pair = vars[i].split("=");

        params[pair[0]] = pair[1];
    }

    return params;
}

function queryReadParam(key) {

    let query = queryRead();

    return query[key];
}