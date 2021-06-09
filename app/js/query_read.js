/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function queryRead() {

    let string = queryGetString();

    return new URLSearchParams(string).values();
}

function queryGetString() {

    return window.location.hash.split("!")[1] || "";
}

function queryReadValue(key) {

    let string = queryGetString();

    let params = new URLSearchParams(string);

    return params.get(key)
}