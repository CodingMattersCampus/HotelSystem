@extends('adminlte::page')
@section('content_header')

@endsection
@section('content')
    <div class="row-fluid" id="app">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-bed"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Rate:</span>
                            <span class="info-box-number text-info">&#8369; {{ number_format($booking->rate, 2) }}</span>
                        </div>
                        <div class="info-box-more">
                            <h5>&nbsp;&nbsp;&nbsp;<small class="text-muted">Room: {{ $booking->room()}}</small></h5>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="box-body box-profile">
                    <p class="text-center" style="font-style: italic;">Net Sales:</p>
                    <h3 class="text-muted text-center text-success text-bold">&#8369;{{number_format($booking->netSales, 2)}}</h3>
                    <div class="divider"><hr></div>
                    <div class="row text-center">
                        <div class="col-md-6 col-sm-6">
                            <p class="box-title text-bold">In</p>
                            <small> {{$booking->checkInDateTime() }}</small>
                            <p> {{$booking->checkedInBy() }}</p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <p class="box-title text-bold">Out</p>
                            <small> {{ $booking->checkOutDateTime() }}</small>
                            <p> {{$booking->checkedOutBy() }}</p>
                        </div>
                    </div>

                    @if(!empty($booking->taxi()))
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Taxi</b> <a class="pull-right text-uppercase">{{ $booking->taxi() }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Referral Fee</b> <a class="pull-right">{{ $booking->taxi_referral_fee }}</a>
                            </li>
                        </ul>
                    @endif
                </div>
                <div class="box-footer">
                    <h5 class="pull-left"> <small>Booking No.: {{ $booking->transaction() }} </small></h5>
                    <h5 class="pull-right"> <small>Last update: {{ $booking->updated_at->diffForHumans() }}</small></h5>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#orders" data-toggle="tab" aria-expanded="true">Orders <small class="text-muted">(&#8369;{{number_format($booking->totalOrders(), 2)}})</small></a>
                    </li>
                    <li>
                        <a href="#penalties" data-toggle="tab" aria-expanded="true">Penalties <small class="text-muted">(&#8369;{{number_format($booking->penalties, 2)}})</small></a>
                    </li>
                    <li>
                        <a href="#transfer" data-toggle="tab" aria-expanded="true">Transfers <small class="text-muted">(&#8369;{{number_format($booking->transfers, 2)}})</small></a>
                    </li>
                    <li>
                        <a href="#extends" data-toggle="tab" aria-expanded="true">Extensions <small class="text-muted">(&#8369;{{number_format($booking->extends, 2)}})</small></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="orders">
                        <table id="orders-table" class="table table-responsive table-striped table-hover" style="width:100%">
                            <thead class="bg-purple-gradient">
                            <tr>
                                <th>#</th>
                                <th>Transaction</th>
                                <th>Date and Time</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Received By</th>
                            </tr>
                            </thead>
                        </table>
                        <div class="clearfix"></div>
                    </div>
                    <div class="tab-pane" id="penalties">
                        <table id="penalties-table" class="table table-responsive table-striped table-hover" style="width:100%">
                            <thead class="bg-purple-gradient">
                            <tr>
                                <th>#</th>
                                <th>Transaction</th>
                                <th>Date and Time</th>
                                <th>Penalty</th>
                                <th>Rate</th>
                                <th>Received By</th>
                            </tr>
                            </thead>
                        </table>
                        <div class="clearfix"></div>
                    </div>
                    <div class="tab-pane" id="transfer">
                        <table id="transfer-table" class="table table-responsive table-striped table-hover" style="width:100%">
                            <thead class="bg-purple-gradient">
                            <tr>
                                <th>#</th>
                                <th>Transaction</th>
                                <th>Date and Time</th>
                                <th>Reason</th>
                                <th>Payment</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Received by</th>
                            </tr>
                            </thead>
                        </table>
                        <div class="clearfix"></div>
                    </div>
                    <div class="tab-pane" id="extends">
                        <table id="extend-table" class="table table-responsive table-striped table-hover" style="width:100%">
                            <thead class="bg-purple-gradient">
                            <tr>
                                <th>#</th>
                                <th>Transaction</th>
                                <th>Date and Time</th>
                                <th>Extended</th>
                                <th>Payment</th>
                            </tr>
                            </thead>
                        </table>
                        <div class="clearfix"></div>
                    </div>
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
    $('#orders-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { "data": "id", searchable: false, orderable: false },
            { "data": "transaction", searchable: true, orderable: false },
            { "data": "created_at", orderable: false, searchable: true },
            { "data": "product", searchable: true, orderable: false },
            { "data": "price", orderable: false, searchable: false },
            { "data": "quantity", searchable: false, orderable: false },
            { "data": "total", searchable: false, orderable: false },
            { "data": "cashier", orderable: false, searchable: true },
        ],
        "ajax": {
            "url": "{{\route('api.booking.orders', compact('booking'))}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });
</script>
<script type="text/javascript">
    $('#penalties-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { "data": "id", searchable: false, orderable: false },
            { "data": "transaction", searchable: true, orderable: false },
            { "data": "created_at", orderable: false, searchable: true },
            { "data": "penalty", searchable: true, orderable: false },
            { "data": "rate", orderable: false, searchable: false },
            { "data": "cashier", orderable: false, searchable: true },
        ],
        "ajax": {
            "url": "{{\route('api.booking.penalties', compact('booking'))}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });
    $('#transfer-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { "data": "id", searchable: false, orderable: false },
            { "data": "transaction", searchable: true, orderable: false },
            { "data": "created_at", orderable: false, searchable: true },
            { "data": "reason", orderable: false, searchable: true },
            { "data": "payment", orderable: false, searchable: true },
            { "data": "from", searchable: true, orderable: false },
            { "data": "to", orderable: false, searchable: false },
            { "data": "employee", orderable: false, searchable: true },
        ],
        "ajax": {
            "url": "{{\route('api.booking.transfers', compact('booking'))}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });

    $('#extend-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { "data": "id", searchable: false, orderable: false },
            { "data": "transaction", searchable: true, orderable: false },
            { "data": "created_at", orderable: false, searchable: true },
            { "data": "hours", orderable: false, searchable: true },
            { "data": "payment", orderable: false, searchable: true },
        ],
        "ajax": {
            "url": "{{\route('api.booking.extends', compact('booking'))}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });
</script>
@endpush