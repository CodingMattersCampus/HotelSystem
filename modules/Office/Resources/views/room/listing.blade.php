@extends('adminlte::page')

@section('content')
<div class="container-fluid" id="app">
    <div class="row">
        <div id="chart" ></div>
    </div>
    <div class="row">
        <div class="col-md-3">
        <form class="form" method="POST" action=" {{ route('office.room.create') }}">
                @csrf
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="#name">Number</label>
                    <input type="text" id="name" name="name" class="form-control">
                    @if ($errors->has('name'))
                        <span class="text-warning">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="#type">Type:</label>
                    <select id="type" name="type" class="form-control">
                        @foreach( $types as $type)
                            <option value="{{ $type }}"> {{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="#booking_rate">Rate:</label>
                    <select id="booking_rate" name="booking_rate" class="form-control">
                            <option value="300" selected>Short Time</option>
                            <option value="500">12 Hours</option>
                            <option value="1000">24 Hours</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="#booking_duration">Duration</label>
                    <select id="booking_duration" class="btn btn-sm btn-default form-control" name="booking_duration">
                            <option value="4">4 Hours</option>
                            <option selected value="12">12 Hours</option>
                            <option value="24">24 Hours</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="#blanket">Blanket</label>
                    <input type="number" id="blanket" name="blanket" class="form-control" value='1'>
                </div>
                <div class="form-group">
                    <label for="#bedsheets">Bedsheets</label>
                    <input type="number" id="bedsheets" name="bedsheets" class="form-control" value='1'>
                </div>
                <div class="form-group">
                    <label for="#pillows">Pillows</label>
                    <input type="number" id="pillows" name="pillows" class="form-control" value='2'>
                </div>
                <div class="form-group">
                    <label for="#towels">Towels</label>
                    <input type="number" id="towels" name="towels" class="form-control" value='2'>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary form-control" data-toggle="modal" data-target="#newRoomModal"><i class="fa fa-plus">&nbsp;</i>New Room</button>
                </div>
            </form>
        </div>
        <div class="col-md-9">
            <div class="card bg-gray-light">
                <div class="row-fluid">
                    <div class="box box-primary collapsed-box">
                        <div class="box-header">
                            <h3 class="box-title">Room Summary</h3>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <table id="rooms-table" class="table table-responsive table-striped table-condensed table-hover">
                        <thead class="bg-purple-gradient">
                        <tr>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="clearfix"><br></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<meta name="csrf-token" content="{{@csrf_token()}}">
@endsection
@section('js')
<script src="{{ \asset('vendor/apexcharts/js/apexcharts.js') }}"></script>
<script type="text/javascript">
$(function() {
    const table = $('#rooms-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            {"data": "name", orderable: true, searchable: true},
            {"data": "type", searchable: true, orderable: true},
            {"data": "status", searchable: true, orderable: true},
        ],
        "ajax": {
            "url": "{{\route('api.office.rooms.all')}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            }
        }
    });

    //click rows
    $('#rooms-table tbody').on('click', 'tr', function () {
        const data = table.row( this ).data();
        window.location.href = ""+ data['code'] +"/settings";
    });

    console.log(ApexCharts);
    const chart = new ApexCharts(document.querySelector("#chart"),options);
    var ChartData = {
        getdata:function(){
             $.ajax({
                url: "{{\route('api.charts.rooms.listing')}}",
                method: 'POST',
                data: {
                    "api_token": "{{ $token }}",
                },
                dataType: 'json',
                success(d){
                    series = d.data.series;
                    for( room in series){
                        appendable = {
                            name: room,
                            data: []
                        }

                        for (var i = 1; i <= 31; i++) {
                            dayItem = series[room].data.findIndex(o => o.x == i) //get item with day
                            if(dayItem < 0){
                                appendable.data.push( { x: i, y : 0 }) //change y into default value
                            } else {
                                appendable.data.push( series[room].data[dayItem]);
                            }
                        }

                        roomdata = options.series.findIndex(o => o.name == room);
                        options.series[roomdata] = appendable;
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
    ChartData.getdata()
        
        $('.apexcharts-title-text').hide();
        $('.apexcharts-title-text').css('display','none');
        $('.apexcharts-menu-icon').hide();
        $('.apexcharts-menu-icon').css('display','none');
});

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
                height: 650,
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
            colors: ["#FFFFFF"], // default as white
            series: [
                {
                    name: '01',
                    data: generateDummy(31)
                },
                {
                    name: '02',
                    data: generateDummy(31)
                },
                {
                    name: '03',
                    data: generateDummy(31)
                },
                {
                    name: '04',
                    data: generateDummy(31)
                },
                {
                    name: '05',
                    data: generateDummy(31)
                },
                {
                    name: '06',
                    data: generateDummy(31)
                },
                {
                    name: '07',
                    data: generateDummy(31)
                },
                {
                    name: '08',
                    data: generateDummy(31)
                },
                {
                    name: '09',
                    data: generateDummy(31)
                },
                {
                    name: '10',
                    data: generateDummy(31)
                },
                {
                    name: '11',
                    data: generateDummy(31)
                },
                {
                    name: '12',
                    data: generateDummy(31)
                },
                {
                    name: '13',
                    data: generateDummy(31)
                },
                {
                    name: '14',
                    data: generateDummy(31)
                },
                {
                    name: '15',
                    data: generateDummy(31)
                },
                {
                    name: '16',
                    data: generateDummy(31)
                },
                {
                    name: '17',
                    data: generateDummy(31)
                },
                {
                    name: '18',
                    data: generateDummy(31)
                },
                {
                    name: '19',
                    data: generateDummy(31)
                },
                {
                    name: '20',
                    data: generateDummy(31)
                },
                {
                    name: '21',
                    data: generateDummy(31)
                },
                {
                    name: '22',
                    data: generateDummy(31)
                },
                {
                    name: '23',
                    data: generateDummy(31)
                },
                {
                    name: '24',
                    data: generateDummy(31)
                },
                {
                    name: '25',
                    data: generateDummy(31)
                },
                {
                    name: '26',
                    data: generateDummy(31)
                },
                {
                    name: '27',
                    data: generateDummy(31)
                },
                {
                    name: '28',
                    data: generateDummy(31)
                },
                {
                    name: '29',
                    data: generateDummy(31)
                },
                {
                    name: '30',
                    data: generateDummy(31)
                },
                {
                    name: '31',
                    data: generateDummy(31)
                },
                {
                    name: '32',
                    data: generateDummy(31)
                },
                {
                    name: '33',
                    data: generateDummy(31)
                },
                {
                    name: '34',
                    data: generateDummy(31)
                },
                {
                    name: '35',
                    data: generateDummy(31)
                },
                {
                    name: '36',
                    data: generateDummy(31)
                },
                {
                    name: '37',
                    data: generateDummy(31)
                },
                {
                    name: '38',
                    data: generateDummy(31)
                },
                {
                    name: '39',
                    data: generateDummy(31)
                },
                {
                    name: '40',
                    data: generateDummy(31)
                },
            ],
        };

    
</script>
@endsection