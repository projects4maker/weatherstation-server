/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
function statusbar(d='', s=0) {

    //case date
    date = new Date(d);
    now = new Date();

    bar = $('#dashboard-head .user-section .info-tab'); 

    pill = function(bar, txt, cls) {

        $(bar + ' .status-pill').html(txt);

        $(bar + ' .status-pill').removeClass('badge-secondary');
        $(bar + ' .status-pill').removeClass('badge-danger');
        $(bar + ' .status-pill').removeClass('badge-warning');
        $(bar + ' .status-pill').removeClass('badge-success');

        $(bar + ' .status-pill').addClass('badge-'+cls);
    }

    txt = function(bar, txt) {
        $(bar + ' .status-text').html(txt);
    }

    case_day = function(date, now) {

        today = now.getFullYear() + now.getMonth() + now.getDate();
        thatday = date.getFullYear() + date.getMonth() + date.getDate();
        if(today == thatday) {

            return 'today'; //TODO
        }
    }
  
    switch (s) {

        case 0:

            txt(bar, 'Status unknown.');
            pill(bar, 'Unknown', 'secondary');
            break;
        case 1:

            minutes = Math.round((date.getTime() - now.getTime())*100/6);

            txt(bar, 'Last update' + minutes + 'minuts ago.');
            pill(bar, 'Up to date', 'success');
            break;
        case 2:

            pill(bar, 'Nearly outdated', 'warning');
            break;
        case 3:

            pill(bar, 'Outdated', 'danger');
            break;
    }

}

//0:unknown: Failed
//1:up to date: "Success" = last 15 min
//2:nearly: "Warning" = more than 3 hours ago
//3:Outdated: "Danger" = more than 6 hours ago