@extends('adminlte::page')
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="box">
            <div class="box-body box-profile">
                <div class="profile_image">
                    <img src="{{asset('images/no-image.jpg')}}" class="profile-user-img img-responsive img-circle" alt="jigs" width="40%" >
                </div>
                <div class="pofile_information">
                    <h4 class="profile-username text-center "><a>{{ $cashier->fullname }}</a></h4>
                    <h6 class="text-muted text-center"></h6>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="text-bold text-center" style="margin-top: 0px;">Beginning</h4>
                        <em> {{ $remittance->beginningTransaction() }}</em>
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-bold text-center" style="margin-top: 0px;">Ending</h4>
                        <em> {{ $remittance->endingTransaction() }}</em>
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <h5 class="text-bold">Total Remitted <span class="pull-right">{{ $remittance->remittedAmount() }}</span></h5>
                    <h5 class="text-bold">Expected Remittance <span class="pull-right">{{ $remittance->expectedAmount() }}</span></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#drawer" data-toggle="tab" aria-expanded="true">Cash Transactions</a>
                </li>
                <li>
                    <a href="#inventory" data-toggle="tab" aria-expanded="true">Inventory</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="drawer">
                    <table id="cash-transactions-table" class="table table-responsive table-striped table-hover">
                        <thead class="bg-purple-gradient">
                        <tr style="background-color:rgb(60, 141, 188)">
                            <th>#</th>
                            <th>Transaction</th>
                            <th>Date Time</th>
                            <th>Particulars</th>
                            <th>Amount</th>
                            <th>Cash</th>
                            <th>Change</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="tab-pane" id="inventory">
                    <table id="inventory-transactions-table" class="table table-responsive">
                        <thead class="bg-purple-gradient">
                        <tr style="background-color:rgb(60, 141, 188)">
                            <th>#</th>
                            <th>Product</th>
                            <th>Remitted</th>
                            <th>Remaining</th>
                        </tr>
                        </thead>
                    </table>
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
<script type="text/javascript">
    $('#cash-transactions-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { "data": "id", searchable: false, orderable: false },
            { "data": "transaction", searchable: true, orderable: false },
            { "data": "created_at", searchable: true, orderable: false },
            { "data": "description", searchable: true, orderable: false },
            { "data": "amount", orderable: false, searchable: false },
            { "data": "cash", orderable: false, searchable: false },
            { "data": "change", orderable: false, searchable: false },
        ],
        "ajax": {
            "url": "{{\route('api.cash.drawer.transactions', compact('drawer'))}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });
</script>
<script type="text/javascript">
    $('#inventory-transactions-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { "data": "id", searchable: false, orderable: false },
            { "data": "product", orderable: false, searchable: true },
            { "data": "remitted", orderable: false, searchable: false },
            { "data": "remaining", orderable: false, searchable: false },
        ],
        "ajax": {
            "url": "{{\route('api.cashier.inventory.remittance', compact('drawer'))}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });
</script>
@endpush