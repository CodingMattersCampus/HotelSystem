<!-- Modal -->
<div id="order-modal" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">
<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header" style="background-color:rgb(60, 141, 188); color:white; padding: 5px;">
        <div class="col-md-4">
            <h3 class="modal-title"> Room #: </h3>
        </div>                                
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body" style="color:black;">
        <!-- body -->
            <div class="col-md-8">
                <div class="row" style="padding-left:10px; padding-right:25px;">
                    <h4 style="margin:0 0 5px 0;">Orders</h4>
                    <div class="card" style="padding: 0 15px 0 0;">
                        <div class="row-fluid">
                            <div class="dropdown">
                                <input type="text" id="search_orders" data-toggle="dropdown" autocomplete="off" class="form-control" placeholder="Search Product" aria-label="Search Product">
                                <ul id="searched-orders" class="dropdown-menu list-group" style="width: 100%; margin: 0px;" aria-labelledby="search_orders">
                                    <li class="list-group-item" disabled>Search Items</li>
                                </ul>
                            </div>
                            <table id="order_table" class="table table-responsive table-striped table-condensed table-hover" style="width:100%">
                                <thead class="bg-purple-gradient">
                                    <tr>
                                        <th>SKU</th>                                              
                                        <th>Name</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>SubTotal</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="base_tr1">
                                        <td></td>
                                        <td class="order_rate"></td>
                                        <td class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="padding:0;">
                <div class="row" style="padding:10px;" >
                    <div style="padding:10px;background-color:rgb(60, 141, 188);border-radius:10px; color:white;" >
                        <form id="orderFeeForm" action="{{route('booking.room.order', compact('room'))}}" method="post">
                            @csrf
                            <div class="form-group ">
                                <label >Total Fee:</label>
                                <input style="border-radius:10px;" class="form-control" type="text" name="total_amount" id="total_OrderFee" readonly  value="0"/>
                            </div>
                            <div class="form-group ">
                                <label for="cash_received">Cash:</label>
                                <input style="border-radius:10px;" class="form-control" type="number" name="cash" id="order_cashreceived" value="0" required/>
                            </div>
                            <div  class="form-group ">
                                <label  id="">Change</label>
                                <input style="border-radius:10px;"  class="form-control" type="text" name="change" id="order_cash_change" value="" readonly placeholder="0" />
                                <span id="message"></span>
                            </div>
                            <div  class="form-group" style="text-align:center; margin-top:30px; " >
                                <button style="background-color:rgb(60, 141, 188); color: white; border:1px solid white;" type="submit" id="order_modal_button" class="btn btn-block">Add Order</button>
                            </div>
                            <input type="hidden" name="orders" id="orderset">
                        </form>
                    </div>
                </div>
            </div>
      <!-- body -->
    </div>
    <div class="modal-footer" style="border:1px solid white;"></div>
</div>
</div>
</div>

@push('js')
<script type="text/javascript">
$(document).ready(function(){
    if(typeof(Storage) !== 'undefined'){
        // localStorage.dt_arr = new Array; //never instantiate
        if(!localStorage.hasOwnProperty('orders_arr')){
            localStorage.setItem('orders_arr',JSON.stringify([]));
        }
    } else {
        $('#order-modal').find('.modal-footer').html('<p id="store-warning" class="text-warning">Browser Storage is not supported for this browser.</p>');
    }

    var orders_dt = $('#order_table').DataTable({
        "dom": 't',
        "buttons": [],
        "deferRender": true,
        "columns": [
            { "data": "sku", orderable: true, searchable: true },
            { "data": "name", searchable: true, orderable: true },
            { "data": "brand", searchable: true, orderable: true },
            { "data": "price", searchable: false, orderable: false },
            { "data": "quantity", "defaultContent": 1, searchable: false, orderable: false,
                render(d,t,r) {
                    r.quantity = r.quantity ? r.quantity : 1;
                    return '<input style="width:80px;" value="'+r.quantity+'"">';
                }},
            { "data": "amount",searchable: true, orderable: false,
                render:function(d,t,r) {
                    r.amount = (r.quantity * r.price).toFixed(2);
                    return r.amount;
                }},
            { "data": "remove", defaultContent: '<i class="fa fa-times text-red"></i>', "orderable": false, "searchable": false },
        ],
        data: [],
    });
    //reactive draw method on datatable
    orders_dt.on('draw', function(){
        orderModal.generateFee()
    });
    //Remove items and modify items
    $('#order_table tbody').on( 'click', 'i.fa-times', function () {
        orders_dt
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    } ).on('keyup',"input",function(){
        row = orders_dt.row($(this).parents('tr')).data()
        row.quantity = $(this).val()
        row.amount = (row.price * row.quantity).toFixed(2)
        orders_dt.row($(this).parents('tr')).data(row)
        orders_dt.draw()
    });

    $('#search_orders').on('keyup',function(){
        if(searchedProduct.data == null){
            searchedProduct.search_data();
        }

        input = $(this);
        menu = $('#searched-orders');
        string = input.val();
        menu.html('');
        concern = {
            searchable: ['sku', 'brand', 'name'],
        }

        query = searchedProduct.query(string, concern, 'brand');
        
        query.forEach(function(obj){
            items = obj.toArray();
            li = $('<li/>')
                .addClass("list-group-item bg-aqua")
                .html(obj.key());/*brand*/
            menu.append(li);
            items.forEach(item=>{
                li = $('<li/>')
                    .addClass("list-group-item")
                    .on('click',function(){
                        orders_dt.row.add(item).draw();
                    })
                    .html(item.name);
                menu.append(li);
            });
        });
    });

    var orderModal = {
        roomclicked: null,
        roomname: null,
        generateFee(){
            //Generate fee from table.
            data = orders_dt.column(5).data(); //amount column
            modal = $('#order-modal')
            if(data.length>0){
                fee = data.reduce((a,b)=>parseInt(a)+parseInt(b))
                modal.find('#total_OrderFee').val(fee)
            } else {
                modal.find('#total_OrderFee').val(0)
            }
            
            change = modal.find('#order_cashreceived').val() - modal.find('#total_OrderFee').val();
            modal.find('#order_cash_change').val(change);
            //collect dt data for form
            toForm = this.allData()
            //reset data
            $('#order-modal').find('#orderset')
                    .attr('value', JSON.stringify(toForm));
        },
        changeModalDetail(){
            modal = $('#order-modal')
            modal.find('.modal-title').html('Room #: ' + this.roomname)
            modal.find('#addorder_form').attr('action', "booking/"+this.roomclicked+"/order");
        },
        allData(){
             return orders_dt.rows().data().toArray(); //all data
        },
        //localStorage methods
        preSaveData(){
            id = this.roomclicked
            local = JSON.parse(localStorage.getItem('orders_arr'));
            index = this.getData(true); //index
            tddata = this.allData();//datatable data
            if(index >= 0){
                console.log('data edit')
                local[index] =  {
                    room_code : id,
                    dt : tddata
                }
            } else {
                console.log('data pushed')
                local.push( {
                    room_code : id,
                    dt : tddata
                })
            }
            localStorage.orders_arr = JSON.stringify(local);
        },
        getData(index = false){
            local = JSON.parse(localStorage.getItem('orders_arr'));
            rc = this.roomclicked;
            i = local.findIndex(obj => {
                return obj.room_code == rc
            });

            if(index) {  return i;  }
            if(i>0){  return local[i];  } 

            return false;
        },
        flushData(){

        }
    }

    $('#order-modal').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget) // Button that triggered the modal
        orderModal.roomname = button.data('name')
        orderModal.roomclicked = button.data('room') // Extract info from data-* attributes
        modal = $(this)

        orderModal.changeModalDetail();
    }).on('shown.bs.modal', function (event) {
        modal = $(this)

        orders_dt.clear(); //doesn't work most of the time. :( issue here
        /* Hunahunaon sa nako ngano ni.*/
        roomdata = orderModal.getData();

        if(roomdata){
            orders_dt.rows.add(roomdata.dt);
            orders_dt.draw()
        }

        modal.find('#order_cashreceived').on("keyup",function(){
            change = $(this).val() - modal.find('#total_OrderFee').val();
            modal.find('#order_cash_change').val(change);
        });

        modal.find('#addorder_form').on('submit', function(event){
            change = modal.find('#order_cash_change').val()
            if(orderModal.allData().length == 0){
                modal.find('#message').html('No Orders!');
                return false;
            }
            if(modal.find('#total_OrderFee').val() == 0 && modal.find('#order_cashreceived').val() > 0)
                return false; //hardrule. no fee no cash required
            if(change && change >= 0){
                return true;
            } else {
                modal.find('#message').html('Insufficient Amount or Change is null');
                return false;
            }
        });

    }).on('hide.bs.modal', function(event){
        if(orderModal.roomclicked != null){
            orderModal.preSaveData()
        }
    });
});
</script>
@endpush