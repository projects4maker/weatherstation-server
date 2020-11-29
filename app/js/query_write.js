/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function queryWrite(params={}) {

    let query = new URLSearchParams(params).toString();

    let hash = window.location.hash.split("!")[0];

    if(hash == "#" || hash == "") {

        hash = "live";
    }

    window.location.hash = hash + "!" + query;
    
}

function queryAddParam(key, value) {
    
    let query = queryRead();

    query[key] = value;

    queryWrite(query);
}