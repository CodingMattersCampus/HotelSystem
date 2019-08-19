@extends('adminlte::page')

@push('css')
<style type="text/css">
    #roomrates dt {
        border-bottom: 1px solid rgb(0, 0, 0, 0.15);
    }
    #roomrates dd {
        margin: 10px 15px;
        font-size: 1.2em;
    }
</style>
@endpush

@section('content')
<div class="container-fluid" id="app">
    @include('office::room.room-chart')
    <div class="col-md-3">
        <div class="box box-primary" style="padding: 0 ; margin-top:0;box-shadow: 0 0 15px  rgb(0,0,0,0.6); ">
            <div id="roomnumber" style="background: linear-gradient(to right,rgb(0, 96, 21),rgb(0, 185, 48));  margin-top:0; height:90px;" class="text-left">
                <br>
                <h1  style="color:white; padding-left:5px; padding-right:10px;">{{ $room->name }}
                    <select style=""   id="roomstatus" class="btn btn-sm btn-default pull-right" >
                        <option id="status1" value="available">Available </option>
                        <option id="status2" value="occupied">Occupied</option>
                        <option id="status3" value="cleaning">Cleaning</option>
                        <option id="status4" value="maintenance">Maintenance</option>
                    </select>
                </h1>
            </div>                   
            <div class="box-body box-profile" style="padding:0 0 10px 0;"> 
                <hr style="border:1px solid white; margin:5px;">
                    <div class="box-primary" style="padding: 0 10px 10px 10px;">
                    <h3>Linens:</h3>
                    <hr style="width:100%; margin:10px; margin-left:0%;">
                    <div class="col-md-12" style=" padding:0; " >
                    <table style="border:1px solid rgb(236, 240, 245); border-radius:10px; padding:10px; width:100%;">
                        <thead  >
                            <th style="text-align:center; padding:10px; ">Towels</th>
                            <th style="text-align:center;  padding:10px; ">Pillows</th>     
                        </thead>
                        <tbody>
                            <tr style=" padding:10px; ">
                                <td style="text-align:center;  padding:10px; ">{{$room ->towels }}pcs</td>
                                <td style="text-align:center;  padding:10px; ">{{$room ->pillows}}pcs</td>
                            </tr>
                        </tbody>
                    </table>        
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <h4>Room Rates</h4>
                <div class="col-md-12">
                    <dl id="roomrates">
                        <dt>Short Time 
                            <span data-tag='ST' class="editor pull-right"><i class="fa fa-edit text-blue" title="Edit room rate"></i></span>
                        </dt>
                        <dd data-tag='ST' data-value="350">350</dd>
                        <dt>Half Day 
                            <span data-tag='HD' class="editor pull-right"><i class="fa fa-edit text-blue" title="Edit room rate"></i></span>
                        </dt>
                        <dd data-tag='HD' data-value="950">950</dd>
                        <dt>Whole Day 
                            <span data-tag='WD' class="editor pull-right"><i class="fa fa-edit text-blue" title="Edit room rate"></i></span>
                        </dt>
                        <dd data-tag='WD' data-value="1050">1050</dd>
                    </dl>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-md-9">
    <div class="nav-tabs-custom" style=" box-shadow: 0 0 15px  rgba(0,0,0,0.2); " >
        <ul class="nav nav-tabs">   
            <li class="active">
                <a href="#attendance" data-toggle="tab" aria-expanded="true">Booking History</a>
            </li>
            <li>
                <a href="#rate-history" data-toggle="tab" aria-expanded="true">Room Rate History</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="attendance">
                <table id="bookings-table" class="table table-responsive table-striped table-hover">
                    <thead class="bg-purple-gradient">
                    <tr>
                        <th>#</th>
                        <th>Transaction</th>
                        <th>In By</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Out By</th>
                        <th>Rate</th>
                        <th>Orders</th>
                        <th>Penalties</th>
                        <th>Taxi Fee</th>
                        <th>Net Sales</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane" id="rate-history">
                <table id="bookings-rates-table" class="table table-responsive table-striped table-hover">
                    <thead class="bg-purple-gradient">
                    <tr>
                        <th>Name</th>
                        <th>Reason</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Updated At</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
 </div>
    </div>
  </div>
  </div> 
</div>
@endsection
@push('js')
<script src="{{ \asset('js/room.js') }}" type="text/javascript"></script>
<script src="{{ \asset('vendor/apexcharts/js/apexcharts.js') }}"></script>
<script type="text/javascript">
        $('.apexcharts-title-text').hide();
        $('.apexcharts-title-text').css('display','none');
        $('.apexcharts-menu-icon').hide();
        $('.apexcharts-menu-icon').css('display','none');
    $(function(){
        if($('#roomstatus').val() != '{{$room->status}}')
            $('#roomstatus').val('{{$room->status}}')
            if($('#roomstatus').val() == 'cleaning'){
                $('#roomnumber').css('background','linear-gradient(to right,rgb(12, 160, 204),rgb(6, 121, 186))');
            }
            else if ($('#roomstatus').val() == 'avaiable'){
                $('#roomnumber').css('background','linear-gradient(to right,rgb(0, 96, 21),rgb(0, 185, 48))');
            }
            else if($('#roomstatus').val() == 'maintenance'){
                $('#roomnumber').css('background','linear-gradient(to right,rgb(64, 64, 64),rgb(143, 143, 143))');
            }
            else if ($('#roomstatus').val() == 'occupied'){
                $('#roomnumber').css('background','linear-gradient(to right,rgb(153, 1, 0),rgb(212, 0, 2))');
            }
           
        $('#roomstatus').change(function(){
            $.post('{{ route("office.room.status", ["room"=> $room] ) }}',
                { status: $(this).val(), _token: "{{ csrf_token() }}" }, 
                function(res){
                console.log(res);
            }).fail(function(error){
                alert('error');
            }).done(function(message){
                
            });
        });

        $('#roomrates').on('click','dt span.editor', function(e){
            roomrates = $(e.delegateTarget); //datalist
            tag = $(e.currentTarget).data('tag') //tag string
            span = $(this);
            icon = span.find('i');
            dd = roomrates.find("dd[data-tag="+tag+"]"); //dd jquery instance; get value by dd.data('value')

            //Add conditionals here
            if(false){
                return;
            }

            if(icon.hasClass('fa-edit') && !icon.hasClass('fa-save')){
                dd.empty();
                icon.removeClass('fa-edit');
                icon.addClass('fa-save');
                input = $('<input />').addClass('form-control').val( dd.data('value') );
                dd.append(input);
            } else {
                icon.removeClass('fa-save');
                icon.addClass('fa-edit');
                inputVal = dd.find('input').val();
                dd.empty();
                dd.data('value', inputVal)
                dd.html(inputVal);
            }
        });
    });
</script>
<script type="text/javascript" async>
    const rates_table = $('#bookings-rates-table').DataTable();
    const table = $('#bookings-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { "data": "id", searchable: false, orderable: false },
            { "data": "booking_number", searchable: true, orderable: false },
            { "data": "checkin_by", orderable: false, searchable: true },
            { "data": "checkin", searchable: true, orderable: false },
            { "data": "checkout", orderable: false, searchable: true },
            { "data": "checkout_by", orderable: false, searchable: true },
            { "data": "rate", orderable: false, searchable: true },
            { "data": "total_orders", orderable: false, searchable: true },
            { "data": "total_penalties", orderable: false, searchable: true },
            { "data": "taxi", orderable: false, searchable: true },
            { "data": "net_sales", orderable: false, searchable: true },
        ],
        "ajax": {
            "url": "{{\route('api.room.bookings', compact('room'))}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });
    //click rows
    $('#bookings-table tbody').on('click', 'tr', function () {
        const data = table.row( this ).data();
        window.location.href = "/bookings/"+ data['code'] +"/summary";
    });

    // fetch updates every 1 hour
    setInterval( function () {
        table.ajax.reload();
        chartdata.getDataAjax(current.getMonth());
    }, 360000 );
</script>
@endpush