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

        $(bar + " .status-pill").removeClass("badge-secondary");
        $(bar + " .status-pill").removeClass("badge-danger");
        $(bar + " .status-pill").removeClass("badge-warning");
        $(bar + " .status-pill").removeClass("badge-success");

        $(bar + " .status-pill").addClass("badge-"+cls);
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

            txt(bar, "Last update " + minutes_ago(now,date) + " minutes ago. " + case_day(now,date) + " at " + current_time(date) + ".");
            pill(bar, "Up to date", "success");
            break;
        case 2:

            txt(bar, "Last update " + Math.round(minutes_ago(now,date)/60) + " hours ago. " + case_day(now,date) + " at " + current_time(date) + ".");
            pill(bar, "Nearly outdated", "warning");
            break;
        case 3:

            day = case_day(now,date);

            if(day == "today" || day == "yesterday") {

                txt(bar, "Last update " + day + " at " + current_time(date) + ".");
            } else {

                txt(bar, "Last update " + date.toLocaleDateString() + " at " + current_time(date) + ".");
            }

            pill(bar, "Outdated", "danger");
            break;
    }

}

//0:unknown: Failed
//1:up to date: "Success" = last 15 min
//2:nearly: "Warning" = more than 3 hours ago
//3:Outdated: "Danger" = more than 6 hours ago