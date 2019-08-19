@extends('adminlte::page')

@section('content')
<div class="container-fluid" id="app">
    <div class="col-md-3">
        <form class="form" method="POST" action=" {{ route('store.room.create') }}">
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
@endsection
@section('css')
<meta name="csrf-token" content="{{@csrf_token()}}">
@endsection
@section('js')
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
<script type="text/javascript">
    $(function() {

        var table = $('#rooms-table').DataTable({
            "dom": 'Bfrtip',
            "buttons": ['pageLength', 'pdf', 'csv'],
            "lengthMenu": [[10, 50, -1], [10, 50, "All"]],
            "serverSide": true,
            "deferRender": true,
            "columns": [
                { "data": "name", orderable: true, searchable: true },
                { "data": "type", searchable: true, orderable: true },
                { "data": "status", searchable: true, orderable: false },
            ],
            "ajax": {
                "url": "{{\route('api.office.rooms.all')}}",
                "method": "POST",
                "data": {
                    "api_token": "{{ $token }}",
                },
            }
        });
        //click rows
        $('#rooms-table tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            window.location.href = ""+ data['code'] +"/settings";
        });
    });
</script>
@endsection