/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function statusbar(datestring="", status=0) {


    //case date
    date = new Date(datestring);
    now = new Date();

    let bar = "#dashboard-head .user-section .info-tab"; 

    pill = function(bar, txt, cls) {

        $(bar + " .status-pill").html(txt);

        ['secondary', 'danger', 'warning', 'success'].forEach(function(key) {
            
            $(bar + " .status-pill").removeClass("badge-" + key);
        });

        $(bar + " .status-pill").addClass("badge-" + cls);
    }

    txt = function(bar, txt) {
        $(bar + " .status-text").html(txt);
    }

    case_day = function(n,d) {

        today = n.getFullYear() + n.getMonth() + n.getDate();
        thatday = d.getFullYear() + d.getMonth() + d.getDate();
        if(today == thatday) {

            return "today";
        } else if(today-1 == thatday) {

            return "yesterday";
        } else {

            return "else";
        }
    }

    current_time = function(d) {

        string = "";

        if(d.getHours() < 10) {

            string = "0" + d.getHours();
        } else {

            string = d.getHours();
        }

        string = string + ":";

        if(d.getMinutes() < 10) {

            string = string + "0" + d.getMinutes();
        } else {
            
            string = string + d.getMinutes();
        }

        return string;
    }

    minutes_ago = function(n,d) {

        return Math.round((n.getTime() - d.getTime())/(1000*60));
    }
  
    switch (status) {

        case 0:

            txt(bar, "Status unknown.");
            pill(bar, "Unknown", "secondary");
            break;
        case 1:

            let m = minutes_ago(now,date);

            txt(bar, "Last database update " + m + " minute" + (m==1?"":"s") + " ago.");
            pill(bar, "Up to date", "success");
            break;
        case 2:

            txt(bar, "Last database update " + Math.round(minutes_ago(now,date)/60) + " hours ago at " + case_day(now,date) + ", " + current_time(date) + ".");
            pill(bar, "Nearly outdated", "warning");
            break;
        case 3:

            day = case_day(now,date);

            if(day == "today" || day == "yesterday") {

                txt(bar, "Last database update " + day + " at " + current_time(date) + ".");
            } else {

                txt(bar, "Last database update " + date.toLocaleDateString() + " at " + current_time(date) + ".");
            }

            pill(bar, "Outdated", "danger");
            break;
    }

}