@extends('adminlte::page')
@section('content')
<div id="app" class="row">
<div class="col-md-3">
    <div class="box box-solid  box-primary">
        <div class="box-header with-border">
            <h2 class="box-title">{{ strtoupper($taxi->plate) }}</h2>
        </div>
        <div class="box-body">
            <div class="row text-center">
                {{ $taxi->driver }}
            </div>
        </div>
    </div>
</div>
<div class="col-md-9">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#booking" data-toggle="tab" aria-expanded="true">Booking Referrals</a>
            </li>
            <li>
                <a href="#settings" data-toggle="tab" aria-expanded="true">Settings</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="booking">
                <div class="container-fluid">
                    <table id="taxi-booking-referrals-table" class="table table-responsive table-striped table-hover">
                        <thead class="bg-purple-gradient">
                        <tr>
                            <th>Transaction #</th>
                            <th>Cashier</th>
                            <th>Room</th>
                            <th>Checkin Time</th>
                            <th>Checkout Time</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="settings">
                <div class="container-fluid">
                    <form>
                        <div class="row">
                            <div class="col-md-5">
                                PHOTO HERE
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="#driver">Driver:</label>
                                    <input class="form-control" type="text" value="{{$taxi->driver}}" id="driver" name="driver">
                                </div>
                                <div class="form-group">
                                    <label for="#mobile">Cellphone:</label>
                                    <input class="form-control" type="text" id="mobile" name="mobile">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-block btn-primary"><i class="fa fa-save">&nbsp;</i>Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
    $(function() {
        const table = $('#taxi-booking-referrals-table').DataTable({
            "dom": 'Bfrtip',
            "buttons": ['pageLength', 'pdf', 'csv'],
            "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "All"]],
            "serverSide": true,
            "deferRender": true,
            "columns": [
                { "data": "booking_number", searchable: true, orderable: false },
                { "data": "checkin_by", orderable: false, searchable: true },
                { "data": "room", searchable: true, orderable: false },
                { "data": "checkin", searchable: true, orderable: false },
                { "data": "checkout", orderable: false, searchable: true },
            ],
            "ajax": {
                "url": "{{\route('api.taxi.bookings', compact('taxi'))}}",
                "method": "POST",
                "data": {
                    "api_token": "{{ $token }}",
                },
            }
        });

        //click rows
        $('#taxi-booking-referrals-table tbody').on('click', 'tr', function () {
            const data = table.row( this ).data();
            window.location.href = "/bookings/"+ data['code'] +"/summary";
        });
    });
</script>
@endpush