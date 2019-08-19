@extends('adminlte::page')
@section('content')

<div class="container-fluid" id="app">
    <div class="row">
        <div class="chart-container" style="border:1px solid white;margin-bottom:15px; background-color:white;padding:10px 0 10px 10px;">
            <canvas id="myChart" height="110px" ></canvas>    
        </div>
    </div>
    <div class="row">
        <div class="card bg-gray-light" style="background-color:white;">
            <div class="row-fluid">
                <div class="box box-primary collapsed-box">
                    <div class="box-header">
                        <h3 class="box-title">Cash Remittances Summary</h3>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <table id="remittances-table" class="table table-responsive table-striped table-hover">
                    <thead class="bg-purple-gradient">
                    <tr style="background-color:rgb(60, 141, 188)">
                        <th>#</th>
                        <th>Transaction</th>
                        <th>Cashier</th>
                        <th>Remitted</th>
                        <th>Expected</th>
                        <th>From</th>
                        <th>To</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


</div>

@endsection
@push('css')
<meta name="csrf-token" content="{{@csrf_token()}}">
@endpush
@push('js')
<script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>
<script type="text/javascript">
var config = {
    type: 'bar',
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
        datasets: []
    },
    options: {
        scales:  {
            xAxes:[{
                stacked: true
            }],
            yAxes: [{
                stacked: true,
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
}
function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}
function Dataset(label, stack, dataTo){
    this.label = label;
    this.stack = stack;
    this.datato = dataTo;
    this.data = [0,0,0,0,0,0,0,0,0,0,0,0]; //preset data
    this.backgroundColor = getRandomColor();             
}
$(function() {

var ctx = document.getElementById("myChart"); 
var myChart = new Chart(ctx, config);

var chartdata = {
    getDataAjax:function(){
        $.ajax({
            url: "{{\route('api.cash.remittances.chart')}}",
            method: 'POST',
            data: {
                "api_token": "{{ $token }}",
            },
            dataType: 'json',
            success(d){
                for(kMonth in d.data) {
                    month = parseInt(kMonth)
                    monthdata = d.data[kMonth]

                    for(remitter in monthdata){
                        //remit is name of remitter. also as key for object
                        obj = monthdata[remitter];

                        Object.keys(obj).forEach(key => {
                            ds = config.data.datasets.findIndex(o => o.stack == remitter && o.datato == key);
                            if(ds < 0 ){
                                label = remitter;
                                data = new Dataset(label, remitter, key)
                                data.data[month-1] = obj[key];
                                config.data.datasets.push(data);
                            } else {
                                dsObject = config.data.datasets[ds];
                                dsObject.data[month-1] = obj[key];
                                config.data.datasets[ds] = dsObject;
                            }
                        });
                        
                    }
                }                
            },
            error(e){
                console.log('error', e);
            }
        }).done(function(){
            myChart.update()
        });
    },
}

chartdata.getDataAjax()

    const table = $('#remittances-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { "data": "id", searchable: false, orderable: false },
            { "data": "transaction", searchable: true, orderable: false },
            { "data": "cashier", orderable: false, searchable: true },
            { "data": "remitted", orderable: false, searchable: true },
            { "data": "amount", orderable: false, searchable: true },
            { "data": "start", searchable: true, orderable: false },
            { "data": "end", searchable: true, orderable: false },
        ],
        "ajax": {
            "url": "{{\route('api.cash.remittances.all')}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });
    //click rows
    $('#remittances-table tbody').on('click', 'tr', function () {
        const data = table.row( this ).data();
        window.location.href = ""+ data['code'] +"/summary";
    });

    // fetch updates every 1 hour
    setInterval( function () {
        table.ajax.reload();
        chartdata.getDataAjax()
    }, 360000 );
});
</script>
@endpush