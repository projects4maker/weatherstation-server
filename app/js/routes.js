/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */
var routes = {
    "live": {
        id: "live",
        title: "Live-Chart",
        description: "This is a i o u",
        trigger: {
            name: "live-cron",
            type: "cron",
            callable: function(e) {

            } 
        },
        charts: [{
            type:'line',
            data: {
                labels: ['12/12/12 6am'],
                datasets: [{
                    label: 'Current temperature',
                    borderColor: '#20c997',
                    data: [],
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        }],
        controls: [{
            id: "tog-updt",
            html: "<button type=\"button\" value=\"0\" class=\"control-item btn btn-outline-primary btn-sm\">Toggle updates off</button>",
            event: "click",
            callable: function(e) {
                let v = $(this).attr("value");
                $(this).attr("value",v==0?1:0);
                if(v==0) {
                    $(this).html("Toggle updates off");
                } else {
                    $(this).html("Toggle updates on");
                }
            },

        }]
    },
    "h_comp": {
        title: "Test"
    }
};