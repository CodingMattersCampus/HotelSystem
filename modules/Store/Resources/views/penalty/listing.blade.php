@extends('adminlte::page')
@section('content')
<div id="app" class="container-fluid">
<div class="row">
<div class="chart-container" style="border:1px solid white;margin-bottom:15px; background-color:white;padding:10px 0 10px 10px;">
            <canvas id="myChart" height="130px" ></canvas>    
        </div>
</div>
    <div class="row">
        <div class="col-md-2">
            <form method="post" action="{{ \route('store.penalties.create') }}">
                @csrf
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="#name">Penalty Name:</label>
                    <input type="text" id="name" name="name" placeholder="John Doe" class="form-control">
                    @if ($errors->has('name'))
                        <span class="text-warning">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('rate') ? 'has-error' : '' }}">
                    <label for="#rate">Rate :</label>
                    <input type="text" id="rate" name="rate" placeholder="50" class="form-control">
                    @if ($errors->has('rate'))
                        <span class="text-warning">{{ $errors->first('rate') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" data-toggle="modal" class="btn btn-block btn-primary form-control"><i class="fa fa-plus">&nbsp;</i>Make Penalty</button>
                </div>
            </form>
        </div>
        <div class="col-md-10">
            <div class="card bg-gray-light">
                <div class="row-fluid">
                    <div class="box box-primary collapsed-box">
                        <div class="box-header">
                            <h3 class="box-title">Penalty Listing</h3>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <table id="penalty-table" class="table table-responsive table-striped table-hover">
                        <thead class="bg-purple-gradient">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Rate</th>
                            <th>Date Created</th>
                            <th>Date Updated</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
    <meta name="csrf-token" content="{{@csrf_token()}}">
@endsection

@push('js')
<script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>
<script type="text/javascript">
              
var config = {
    type:'bar',
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
        datasets: []
    },
    options: {
        responsive:true,
        scales:  {
            xAxes:[{
                stacked: false
            }],
            yAxes: [{
                stacked:false
            }]
        }
    }
}
              var ctx = document.getElementById("myChart"); 
var myChart = new Chart(ctx, config);

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

function addPenalty(label='Unknown penalty',penalty = ''){
    this.label = label;
    this.penalty = penalty;
    this.fill = false;
    this.data = [0,0, 0, 0, 0, 0, 0,0,0,0,0,0];
    this.backgroundColor = getRandomColor(); 
}

var chartdata = {
    getDataAjax:function(){
        $.ajax({
            url: "{{\route('api.charts.penalties.all')}}",
            method: 'POST',
            data: {
                "api_token": "{{ $token }}",
            },
            dataType: 'json',
            success(d){
                for(month in d.data){
                    index = config.data.labels.indexOf(month);
                    penaltydata = d.data[month]
                    for (penalty in penaltydata)
                    {
                        bpIndex = config.data.datasets.findIndex(o => o.penalty == penalty);

                        if(bpIndex < 0){
                            newPenalty = new addPenalty(penalty, penalty)
                            newPenalty.data[index] = parseFloat(penaltydata[penalty]['Total Fees']).toFixed(2);
                            config.data.datasets.push(newPenalty);
                        } else {
                            config
                                .data
                                .datasets[bpIndex]
                                .data[index] = parseFloat(penaltydata[penalty]['Total Fees']).toFixed(2);
                        }
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
    $(document).ready(function(){
        const table = $('#penalty-table').DataTable({
            "dom": 'Bfrtip',
            "buttons": ['pageLength', 'pdf', 'csv'],
            "lengthMenu": [[15, 50, 100, -1], [15, 50, 100, "All"]],
            "serverSide": true,
            "deferRender": true,
            "columns": [
                { "data": "id", searchable: false, orderable: true },
                { "data": "name", searchable: true, orderable: false },
                { "data": "rate", searchable: false, orderable: false },
                { "data": "created_at", searchable: false, orderable: false },
                { "data": "updated_at", searchable: false, orderable: false },
            ],
             "ajax": {
                 "url": "{{\route('api.penalties.all')}}",
                 "method": "POST",
                 "data": {
                     "api_token": "{{ $token }}",
                 },
             }
        });

        $('#penalty-table tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            window.location.href = ""+ data['slug'] +"/settings";
        });
    })
</script>
@endpush