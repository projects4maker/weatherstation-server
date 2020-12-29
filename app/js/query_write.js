/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function queryWrite(obj) {

    let string = obj.toString();

    if(string != "") {

        string = "!" + string;
    }
    
    let hash = window.location.hash.split("!")[0];

    if(hash == "#" || hash == "") {

        hash = "live";
    }

    window.location.hash = hash + string;
    
}

function querySet(key, value="") {

    let string = queryGetString();

    let query = new URLSearchParams(string);

    if(query.has(key)) {

        if(value == "") {

            query.delete(key);
        } else {

            query.set(key, value);
        }
        
    } else {

        query.append(key, value);
    }

    queryWrite(query);
}