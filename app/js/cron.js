/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function cron() {
    
    let result = $.get(site.sub_path + "api/get", {
        hash: site.hash,
    });

    result.done(function(d) {
        if(d.status == 'ok') {
            if(site.latest.data != d.data[0]) {

                site.latest.data = d.data[0];
            }
            
        } else {

            throwalert("Ajax request failed with: " + d.message,1);
        }
    });

    result.fail(function(resp) {

        if(resp.responseText) {
            
            message = JSON.parse(resp.responseText).message;
            status = 1;
        } else {

            //Server unreachable
            message = "Server unreachable.";
            status = 2;
        }
        
        throwalert("Ajax request failed with: " + message, status);
    });
    
    if(site.latest.data != null) {

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
        
        statusbar(site.latest.data.draw_time, site.latest.status); 

    } else {

        site.latest.status = 0;

        statusbar("", site.latest.status); 
    }
    
    if(site.latest.status == 1) {

        valuedash(site.latest.data, 1);
    } else {

        valuedash({}, 0);
    }

}