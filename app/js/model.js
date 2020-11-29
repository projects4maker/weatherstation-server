/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function model(option) {

    content = '#content';

    /**
     * Define headline
     */
    $(content + ".header .headline .text").html(option.title);
    $(content + ".header .headline small").html(option.description);
    
}