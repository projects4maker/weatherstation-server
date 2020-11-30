/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function model(options) {

    /**
     * Define headline
     */
    $("#content .header .headline .text").html(options.title);
    $("#content .header .headline small").html(options.description);
    
}