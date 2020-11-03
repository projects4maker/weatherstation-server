/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function cron() {
    
    /**
     * preparing cron stuff
     */
    let result = $.get(site.sub_path + "api/get", {
        hash: site.hash,
    });

    result.done(function(d) {
        if(d.status == 'ok') {
            if(site.latest.data != d.data[0]) {

                site.latest.data = d.data[0];
            }
            
        } else {

            alert("Placeholder error: " + d.message);
        }
    });

    result.fail(function(d) {

        alert("Placeholder error: " + d.message);
    });
    
    if(site.latest.data) {

        date = new Date(site.latest.data.draw_time);
        now = new Date();

        minutes = Math.round((now.getTime() - date.getTime())/(1000*60));

        if(minutes < 16) {

            site.latest.status = 1;
        } else if(minutes > 15 && minutes < 180) {

            site.latest.status = 2;
        } else if(minutes > 179) {

            site.latest.status = 3;
        } else {

            site.latest.status = 0;
        }
        
    } else {

        site.latest.status = 0;
    }

    /**
     * job: statusbar
     */
    statusbar(site.latest.data.draw_time, site.latest.status); 
    
    /**
     * job: valuedash
     */
    if(site.latest.status == 1) {

        valuedash(site.latest.data, 1);
    } else {

        valuedash({}, 0);
    }

}