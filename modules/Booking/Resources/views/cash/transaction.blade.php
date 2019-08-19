@extends('adminlte::page')
@section('content')
<div id="app" class="">
    <div class="row">
        <form id="remit" action="{{ route('booking.cash.remit') }}" method="POST">
            @csrf
            <div class="col-md-3">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cash Remittance</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('remitted_amount') ? 'has-error' : '' }}">
                            <label for="#remitted_amount"> Amount to Remit:</label>
                            <input type="number" id="remitted_amount" name="remitted_amount" class="form-control">
                            @if ($errors->has('remitted_amount'))
                                <span class="text-warning">{{ $errors->first('remitted_amount') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="box-tools pull-right">
                            <button class="btn btn-block btn-primary" type="submit" id="submit">Remit and Logout</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Inventory Remittance</h3>
                    </div>
                    <div class="box-body">
                        <table id="product-remit-table" class="display table table-responsive table-striped table-hover" style="width: 100%">
                            <thead class="bg-purple-gradient">
                                <tr style="background-color:rgb(60, 141, 188);">
                                    <th>Product</th>
                                    <th>Brand</th>
                                    <th>Remit Stock</th>
                                </tr>
                            </thead>
                        </table>
                        <input type="hidden" name="product-remits" id="product-remits">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('css')
    <meta name="csrf-token" content="{{@csrf_token()}}">
@endsection
@push('js')
    <script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        products = {
            data: [],
            getProducts(){
                $.ajax({
                    url: "{{\route('booking.products.inventory.orderable')}}",
                    method: 'GET',
                    dataType: 'json',
                    async: false,
                    success(d){
                        products.data = d;
                    },
                    error(e){
                        console.log('error', e);
                    }
                }).done(function(){
                    product_remit_table.rows.add(products.data).draw();
                });
            }
        }

        const product_remit_table = $('#product-remit-table').DataTable({
            "dom": 'ti',
            "buttons": [],
            "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "All"]],
            "paging": false,
            "deferRender": true,
            "columns": [
                { "data": "name", orderable: true, searchable: true },
                { 'data': "brand", orderable: false, searchable: true},
                { "data": "stocks", orderable: false, searchable: true , 
                    render(d,t,r) {
                        r.stocks = r.stocks ? r.stocks : 0;
                        return '<input style="width:80px;" type="text" value="'+r.stocks+'"">';
                    } },
            ],
        });
        
        $('#product-remit-table tbody').on('keyup',"input",function(){
            row = product_remit_table.row($(this).parents('tr')).data()
            row.stocks = $(this).val()
            product_remit_table.row($(this).parents('tr')).data(row)
            // product_remit_table.draw()
        });

        $('#remit').on('click', '#submit', function(){
            form = $('#remit');
            product_remit_table.draw() //secure all data is saved
            remits = product_remit_table.rows().data().toArray();
            console.log(JSON.stringify(remits));
            form.find('#product-remits').val(JSON.stringify(remits))
            return true;
        });

        if(products.data.length == 0){
            products.getProducts();
        }

    });
    </script>
@endpush