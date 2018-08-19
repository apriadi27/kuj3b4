function adminCharts(canvas, data, title) {
    let json, ctx, charts;
    
    json = JSON.parse(data);
    console.log(json);
    
    charts = {
        type: 'horizontalBar',
        data: {
            labels: [],
            datasets: [{
                label: '',
                data: [],
                backgroundColor: [],
                borderColor: [],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
            legend:{
                labels:{
                    fontSize: 24
                }
            }
        }
    };
    charts['data']['labels'] = json['labels'];
    charts['data']['datasets'][0]['label'] = title;
    charts['data']['datasets'][0]['data'] = json['data'];
    charts['data']['datasets'][0]['backgroundColor'] = json['bgColor'];
    charts['data']['datasets'][0]['borderColor'] = json['bgColor'];
    console.log(charts);

    ctx = document.getElementById(canvas).getContext('2d');
    var myChart = new Chart(ctx, charts);
    
}