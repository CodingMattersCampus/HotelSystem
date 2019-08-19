<div class="chart-container" style="border:1px solid white;margin-bottom:15px; background-color:white;padding:10px 0 10px 10px;">
    <canvas id="myChart" height="130px" ></canvas>
</div>
@push('js')
<script type="text/javascript">
    const config = {
        type: 'bar',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
            datasets: [
                {
                    label:'Net Sales',
                    key: 'sub_net_sales',
                    data: [0,0,0,0,0,0,0,0,0,0,0,0],
                    type: 'line',
                    lineTension: 0,
                    fill: false,
                    borderColor:'#000000'
                },
                {
                    label: 'Taxi Fee',
                    key: 'taxi_fees',
                    data: [0,0,0,0,0,0,0,0,0,0,0,0],
                    backgroundColor: '#FC1616',
                    borderColor:'#FC1616',
                    borderWidth: 1
                },
                {
                    label: 'Booking Rates',
                    key: 'booking_rates',
                    data: [0,0,0,0,0,0,0,0,0,0,0,0],
                    backgroundColor: '#003afa',
                    borderColor:'#003afa',
                    borderWidth: 1

                },
                {
                    label: 'Transfers',
                    key: 'transfers',
                    data: [0,0,0,0,0,0,0,0,0,0,0,0],
                    backgroundColor: '#E8B838',
                    borderColor: '#E8B838',
                    borderWidth: 1
                },
                {
                    label: 'Extensions',
                    key: 'extends',
                    data: [0,0,0,0,0,0,0,0,0,0,0,0],
                    backgroundColor: '#FF99D4',
                    borderColor: '#FF99D4',
                    borderWidth: 1
                },
                {
                    label: 'Orders',
                    key: 'orders',
                    data: [0,0,0,0,0,0,0,0,0,0,0,0],
                    backgroundColor: '#559102',
                    borderColor: '#559102',
                    borderWidth: 1
                },
                {
                    label: 'Penalties',
                    key: 'penalties',
                    data: [0,0,0,0,0,0,0,0,0,0,0,0],
                    backgroundColor: '#63aa00',
                    borderColor: '#63aa00',
                    borderWidth: 1
                },
            ]
        },
        options: {
            responsive:true,
            scales:  {
                xAxes:[{
                    stacked: true
                }],
                yAxes: [{
                    stacked:true,
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    };

    $(function() {
        var ctx = document.getElementById("myChart");
        const myChart = new Chart(ctx, config);
        var chartdata = {
            addNulltoNextMonths:function(start=1){
                for (var i = 0; i < config.data.datasets.length; i++) {
                    for (var j = start; j < config.data.datasets[i].data.length; j++) {
                        config.data.datasets[i].data[j].push(null);
                    }
                }
            },
            getDataAjax:function(i = 1){
                $.ajax({
                    url: "{{\route('api.store.bookings.chart')}}",
                    method: 'POST',
                    data: {
                        "api_token": "{{ $token }}",
                        "month": i,
                    },
                    dataType: 'json',
                    success(d){
                        Object.keys(d.data).forEach(a=>{
                            index = config.data.datasets.findIndex(c=>c.key==a);
                            value = d.data[a];
                            if(a == 'taxi_fees'){
                                value = -value;
                            }
                            config.data.datasets[index].data[i-1] = value
                        });
                    },
                    error(e){
                        console.log('error', e);
                    }
                }).done(function(){
                    myChart.update()
                });
            },
            getAllData:function(){
                for (var i = 1; i <= 12; i++) {
                    this.getDataAjax(i);
                }
            }
        };
        chartdata.getAllData();
    });
    </script>
@endpush