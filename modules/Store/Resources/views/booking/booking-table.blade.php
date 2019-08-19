<div class="card bg-gray-light">
    <div class="row-fluid">
        <div class="box box-primary collapsed-box">
            <div class="box-header">
                <h3 class="box-title">Bookings Summary</h3>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <table id="bookings-table" class="table table-responsive table-striped table-hover">
            <thead class="bg-purple-gradient">
            <tr>
                <th>#</th>
                <th>Transaction</th>
                <th>CheckedIn By</th>
                <th>Room</th>
                <th>Checked In</th>
                <th>Checked Out</th>
                <th>CheckedOut By</th>
                <th>Rate</th>
                <th>Orders</th>
                <th>Penalties</th>
                <th>Transfers</th>
                <th>Extensions</th>
                <th>Taxi Fee</th>
                <th>Total Sales</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
@push('js')
<script type="text/javascript">
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
            { "data": "room", searchable: true, orderable: false },
            { "data": "checkin", searchable: true, orderable: false },
            { "data": "checkout", orderable: false, searchable: true },
            { "data": "checkout_by", orderable: false, searchable: true },
            { "data": "rate", orderable: false, searchable: true },
            { "data": "total_orders", orderable: false, searchable: true },
            { "data": "total_penalties", orderable: false, searchable: true },
            { "data": "transfers", orderable: false, searchable: true },
            { "data": "extends", orderable: false, searchable: true },
            { "data": "taxi", orderable: false, searchable: true },
            { "data": "net_sales", orderable: false, searchable: true },
        ],
        "ajax": {
            "url": "{{\route('api.store.bookings.all')}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });
    //click rows
    $('#bookings-table tbody').on('click', 'tr', function () {
        const data = table.row( this ).data();
        window.location.href = ""+ data['code'] +"/summary";
    });
</script>
@endpush