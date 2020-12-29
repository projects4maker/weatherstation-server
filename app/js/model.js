/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function model(options) {


    /**
     * reset the current trigger 
     */
    site.trigger = null;

    /**
     * Define headline
     */
    $("#content .header .headline .text").html(options.title);
    $("#content .header .headline small").html(options.description);
    
    /**
     * Display charts
     */
    $("#content .viewable .chart-columne").html("");

    var ch_counter = options.charts.length;

    site.charts = {};

    site.charts[options.id] = [];

    for(var i = 0; i < ch_counter; i++) {

      var id = 'chart-' + options.id;

        $("#content .viewable .chart-columne").append("\
            <div class=\"chart-container chart-row-" + ch_counter + "\">\
              <canvas id=\"" + id + "-" +  i + "\">Your browser does not support the canvas element.</canvas> \
            </div>");

      site.charts[options.id][i] = new Chart(document.getElementById(id + "-" +  i).getContext('2d'), options.charts[i]);

    }

     /**
      * Display chart control
      */
     $("#content .viewable .chart-controls").html("");

     site.controls = [];

     var ct_counter = options.controls.length;

     for(var i = 0; i < ct_counter; i++) {

        $("#content .viewable .chart-controls").append(options.controls[i].html);

        $("#content .viewable .chart-controls .control-item").last().attr("id", options.controls[i].id)

        site.controls[i] = document.getElementById(options.controls[i].id).addEventListener(options.controls[i].event, options.controls[i].callable);
     }

    /**
     * set the trigger 
     */
    switch(options.trigger.type) {
      
      case "cron":

        site.trigger = setInterval(options.trigger.callable, options.trigger.time);
        break;
      case "controls":

      //TODO
    }
}