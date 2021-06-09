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
        description: "Live update of all three datas",
        trigger: {
            name: "live-cron",
            type: "cron",
            time: 10000,
            callable: function (e) {
                updateCurrentChart();
            }
        },
        charts: [{
            type: 'line',
            data: {
                labels: ['12/12/12 6am'],
                datasets: [{
                    label: 'Current temperature',
                    borderColor: '#20c997',
                    data: [4,5,6,7],
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
        },
        {
            type: 'line',
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
        },
        {
            type: 'line',
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
            id: "tup",
            html: "<button type=\"button\" value=\"0\" class=\"control-item btn btn-outline-primary btn-sm\">Toggle updates off</button>",
            event: "click",
            callable: function (e) {
                let v = $(this).attr("value");
                $(this).attr("value", v == 0 ? 1 : 0);
                if (v == 0) {
                    $(this).html("Toggle updates off");
                    querySet("tup", "");
                } else {
                    $(this).html("Toggle updates on");
                    querySet("tup", 1);
                }
                updateCurrentChart();
            },

        }]
    },
    "h_comp": {
        title: "Test"
    }
};