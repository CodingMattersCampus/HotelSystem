<div class="row" style="text-align:center;">
    <div id="chart" style="height: 50px;"></div>
</div>

@push('js')
<script type="text/javascript">
$(document).ready(function(){
	function generateDummy(count) {
    var i = 0;
    var series = [];
    while (i < count) {
        series.push({
            x: (i+1).toString(),
            y: 0
        });
        i++;
    }
    return series;
}
var options = {
    chart: {
        height: 450,
        type: 'heatmap',
    },
    legend: {
        show: false,
    },
    tooltip:{
        enabled: false
    },
    plotOptions: {
        heatmap: {
        enableShades: false,
        colorScale: {
            ranges: [
            {
                from: 1,
                to: 1,
                color: 'rgb(148, 212, 237)' //available
            },
            {
                from: 2,
                to: 2,
                color: 'rgb(191, 255, 0)' //occupied
            },
            {
                from: 3,
                to: 3,
                color: 'rgb(249, 1, 9)' //maintenance
            },
            {
                from: 4,
                to: 4,
                color: 'rgb(0, 143, 251)' //cleaning
            },
            ],
        },
        }
    },
    dataLabels: {
        enabled: false,
    },
    colors: ["rgb(255,255,255)"],
    series: [ 
        {
            name: 'December',
            data: generateDummy(31)
        },                
        {
            name: 'November',
            data: generateDummy(31)
        },                 
        {
            name: 'October',
            data: generateDummy(31)
        },                 
        {
            name: 'Semptember',
            data: generateDummy(31)
        },                
        {
            name: 'August',
            data: generateDummy(31)
        },                
        {
            name: 'July',
            data: generateDummy(31)
        },
        {
            name: 'June',
            data: generateDummy(31)
        },                
        {
            name: 'May',
            data: generateDummy(31)
        },                 
        {
            name: 'April',
            data: generateDummy(31)
        },
        {
            name: 'March',
            data: generateDummy(31)
        },
        {
            name: 'February',
            data: generateDummy(31)
        },
        {
            name: 'January',
            data: generateDummy(31)
        }, 
        ],
}

    var ChartData = {
        getdata:function(){
             $.ajax({
                url: "{{\route('api.charts.rooms.year' , compact('room'))}}",
                method: 'POST',
                data: {
                    "api_token": "{{ $token }}",
                },
                dataType: 'json',
                success(d){
                    series = d.data.series;
                    for( month in series){
                        appendable = {
                            name: month,
                            data: []
                        }

                        for (var i = 1; i <= 31; i++) {
                            dayItem = series[month].data.findIndex(o => o.x == i) //get item with day
                            if(dayItem >= 0){
                                appendable.data.push( series[month].data[dayItem]);
                            } else {
                                appendable.data.push( { x: i, y : 0 }) //change y into default value
                            }
                        }
                        // console.log(appendable);
                        monthdata = options.series.findIndex(o => o.name == month);

                        options.series[monthdata] = appendable;
                    }
                },
                error(e){
                    console.log('error', e);
                }
            }).done(function(){
                chart.render();
            });
        },
    }
    
    ChartData.getdata();

        var chart = new ApexCharts(document.querySelector("#chart"),options);   

});
</script>
@endpush