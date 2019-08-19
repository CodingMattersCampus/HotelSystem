@extends('adminlte::page')
@push('css')
<style type="text/css">
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 32px;
  height: 20px;
    padding-left: 18px;
  margin-top: 0;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}
/*Adjust text*/
.switch #text{
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 30px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 14px;
  width: 14px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 50%;

}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(10px);
  -ms-transform: translateX(10px);
  transform: translateX(10px);
}
</style>
@endpush

@section('content')
<div class="row" style="margin: 0;font-family: sans-serif;font-weight: 100;height:100%;width:100%">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-product-hunt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ $product->brandName() }}</span>
                        <span class="info-box-number text-info">{{$product->name}}</span>
                    </div>
                    <div class="info-box-more">
                        <h5>&nbsp;&nbsp;&nbsp;<small class="text-muted">{{$product->sku}}</small></h5>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="box-body box-profile">
                <p class="text-center" style="font-style: italic;">Stock: </p>
                <h3 class="text-muted text-center text-success text-bold">{{ $product->stocks }}</h3>
                <div class="divider"><hr></div>
                <div class="row text-center">
                    <div class="col-md-6 col-sm-6">
                        <p class="box-title text-bold">Price</p>
                        <p> {{ $product->price }} </p>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <p class="box-title text-bold">Cost</p>
                        <p> {{ $product->cost }} </p>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                    <div class="row text-center">
                        <div class="col-md-6 col-sm-6">
                            <p class="text-bold">Orderable</p>
                            <label class="switch checkbox">
                              <input type="checkbox" name="orderable" {{ $product->orderable == 1 ? 'checked': ''}}>
                              <span class="slider"></span>
                            </label>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <p class="text-bold">Consumable</p>
                             <label class="switch checkbox">
                              <input type="checkbox" name="consumable" {{ $product->consumable == 1 ? 'checked': ''}}>
                              <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                    
                <form id="productDetailForm" method="post" action="{{\route('office.inventory.products.detail.edit', compact('product'))}}">
                    @csrf
                    <div class="form-group ">
                        <label >Minimum Threshold:</label>
                        <input style="border-radius:5px;" class="form-control" type="number" name="min_threshold" id="min_threshold" value="{{ $product->min_threshold }}"/>
                    </div>
                    <div class="form-group ">
                        <label for="cash_received">Maximum Threshold:</label>
                        <input style="border-radius:5px;" class="form-control" type="number" name="max_threshold" id="max_threshold" value="{{ $product->max_threshold }}"/>
                    </div>
                    <div  class="form-group ">
                        <label  id="">Profit Margin</label>
                        <input style="border-radius:5px;"  class="form-control" type="number" name="profit_margin" id="profit_margin" value="{{ $product->profit_margin }}"/>
                        <span id="message"></span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        @if($message = session('editmessage'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-info"></i> Alert!</h4>
            {{ $message }}
        </div>
        @endif
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#Inventory" data-toggle="tab" aria-expanded="true">Inventory ({{$product->stocks}})</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="Inventory">
                    <table id="product-transaction-table" class="table table-responsive table-striped table-hover" style="width: 100%;">
                        <thead class="bg-purple-gradient">
                        <tr>
                            <th>#</th>
                            <th>Transaction</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Description</th>
                            <th>Invoice</th>
                            <th>Cost</th>
                            <th>Price</th>
                            <th>In</th>
                            <th>Out</th>
                            <th>Balance</th>
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
$(function() {
    var table = $('#product-transaction-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['pageLength', 'pdf', 'csv'],
        "lengthMenu": [[50, 250, 500, -1], [50, 250, 500, "All"]],
        "serverSide": true,
        "deferRender": true,
        "columns": [
            { 'data': 'id', searchable: true, orderable:true },
            { 'data': 'transaction', searchable: true, orderable:true },
            { 'data': 'date', searchable: true, orderable:true },
            { 'data': 'user', searchable: true, orderable:true },
            { 'data': 'description', searchable: true, orderable:true },
            { 'data': 'invoice', searchable: true, orderable:true },
            { 'data': 'cost', searchable: true, orderable:true },
            { 'data': 'price', searchable: true, orderable:true },
            { 'data': 'in', searchable: true, orderable:true },
            { 'data': 'out', searchable: true, orderable:true },
            { 'data': 'balance', searchable: true, orderable:true },
        ],
        "ajax": {
            "url": "{{\route('api.inventory.products.transactions', compact('product'))}}",
            "method": "POST",
            "data": {
                "api_token": "{{ $token }}",
            },
        }
    });

    $('.switch.checkbox').each(function(){
        $(this).on('change', function(event){
            value = event.target.checked;
            name = event.target.name;
            obj = new Object();
            obj[name] = value;
            $.post("{{\route('office.inventory.products.boolean.edit', compact('product'))}}",
                { toggle: obj, _token: "{{ csrf_token() }}" }, 
                function(res){
                console.log(res);
            }).fail(function(error){
                // alert('error');
            }).done(function(message){
                
            });
            // $.ajax({
            //     url: "{{\route('office.inventory.products.detail.edit', compact('product'))}}",
            //     method: 'POST',
            //     data: {
            //         "api_token": "{{ csrf_token() }}",
            //         toggle: obj
            //     },
            //     dataType:'json',
            //     success:function(d){
            //         if(d.length > 0){
            //             items = d.slice(null, 5);
            //             items.forEach(item=>{
            //                 li = $('<li/>')
            //                     .addClass("list-group-item")
            //                     .on('click',function(){
            //                         datatable.row.add(item).draw();
            //                     })
            //                     .html(item.name+"; Brand: "+item.brand+"");
            //                 menu.append(li);
            //             });
            //         } else {
            //             menu.html('<li class="list-group-item" disabled>Missing Items</li>');
            //         }
            //     }
            // });
        }); 
    });

    // $('#productDetailForm').find('input')
    //     .each(function(input){
    //         name = $(this).attr('name');
    //         form = $('#productDetailForm');
    //         value = $(this).val();
    //         // console.log(name);
    //     });

});
</script>
@endpush