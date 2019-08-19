@push('css')
<style type="text/css">
    .inline-title * {
        display: inline-block;
    }
    .inline-title .form-group {
        margin-bottom: 0px;
    }
    .inline-title .form-group select{
        border: 0px;
        color: rgba(60, 141, 188);
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        font-size: 22px;
        width: 180px;
        background-color: rgba(6,6,6, 0.03);
        font-weight: bold;
        /*firefox arrow removed*/
        -webkit-appearance: none;
        -moz-appearance: none;
        text-indent: 1px;
        text-overflow: '';
    }
    /* chrome */
    .inline-title .form-group select::-ms-expand{
        display: none;
    }
    .inline-title .form-group .form-control {
        padding: 0px 5px;
    }

</style>
@endpush

<div id="checkInForm" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-lg" role="document">
        <!-- Modal content-->
        <div class="modal-content" style="border-radius:10px;">
            <div class="modal-body">
                <form id="bookingform" method="POST" action="{{route('booking.room.book', compact('room'))}}">
                    @csrf
                    <div class="col-md-8" style="margin: 20px 0;">
                        <div class="inline-title">
                            <h3 class="modal-title text-bold">Room: unknown_room</h3>
                            <div class="form-group pull-right">
                                <select id="room-rates" name="booking_rate" class="form-control" title="Booking Rate">
                                    <option data-tag='ST'></option>
                                    <option data-tag='HD'></option>
                                    <option data-tag='WD'></option>
                                </select>
                            </div>
                            <input id="rate_type" type="hidden" name="rate_type">
                        </div>
                        <div class="clearfix"></div>
                        <div class="row" id="taxi_column" hidden>
                            <hr style="margin: 10px 0px">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="#taxi">Taxi Plate #:</label>
                                    <input style="border-radius:10px;" class="form-control" id="plate" name="plate" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="#taxi">Driver :</label>
                                    <input style="border-radius:10px;" class="form-control" id="driver" name="driver" required>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="sc_column" hidden>
                            <hr style="margin: 10px 0px">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="#sc">First Name: </label>
                                    <input style="border-radius:10px;" class="form-control" id="sc_first_name" name="sc_first_name" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="#sc">Middle Name: </label>
                                    <input style="border-radius:10px;" class="form-control" id="sc_middle_name" name="sc_middle_name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="#sc">Last Name: </label>
                                    <input style="border-radius:10px;" class="form-control" id="sc_last_name" name="sc_last_name" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="#sc">Senior Citizen ID:</label>
                                    <input style="border-radius:10px;" class="form-control" id="sc_id" name="sc_id" required>
                                </div>
                            </div>
                        </div>
                        <hr style="margin: 10px 0px">
                        <div class="row">
                            <h4 style="padding: 0px 20px; margin-top: 5px">Orders: </h4>
                            <div class="card">
                                <div class="container-fluid">
                                    <div class="dropdown">
                                        <input type="text" id="item_search" data-toggle="dropdown" autocomplete="off" class="form-control" placeholder="Search Product" aria-label="Search Product">
                                        <ul id="searched-items" class="dropdown-menu list-group" style="width: 100%; margin: 0px;" aria-labelledby="item_search">
                                            <li class="list-group-item" disabled>Search Items</li>
                                        </ul>
                                    </div>
                                    <table id="addon_table" class="table table-responsive table-striped table-condensed table-hover" width="550px">
                                        <thead class="bg-purple-gradient">
                                            <tr>
                                                <th>SKU</th>
                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>SubTotal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4>
                            <span id="booking-option">
                                <div class="dropdown pull-right" style="margin-bottom: 10px;">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Room Options</button>
                                <ul class="dropdown-menu" style="padding: 0px 8px; width: auto;">
                                    <li>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" data-hide="#taxi_column">Taxi Service
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" data-hide="#sc_column" id="sc_priviledge">Senior Citizen Privilege
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div> 
                            </span>
                        </h4>
                        <div class="clearfix"></div>
                        <div class="container-fluid" style="padding:10px;background-color:rgb(60, 141, 188);border-radius:10px;" >
                            <div class="row-fluid">
                                <div class="form-group">
                                    <label for="#addon_total">Orders Subtotal:</label>
                                    <input style="border-radius:10px;" type="text" class="form-control" id="addon_total"  readonly>
                                </div>
                            </div>
                            <div class="row-fluid" >
                                <div class="form-group">
                                    <label for="password">Total Amount<span id="discount" hidden> (Discounted) </span>: </label>
                                    <input style="border-radius:10px;" class="form-control" type="text" name="total_amount" id="totalAmount" readonly  value="0">
                                </div>
                                <div class="form-group">
                                    <label for="password" id="passwordLabel">Cash:</label>
                                    <input style="border-radius:10px;" class="form-control" type="number" name="cash" id="cashReceived" required/>
                                </div>
                                <div  class="form-group">
                                    <label for="passwordConfirm" id="passwordLabelConfirm">Change</label>
                                    <input style="border-radius:10px;"  class="form-control" type="" name="change" id="change" value="" readonly placeholder="0" />
                                    <span id="message"></span>
                                </div>
                                <input id="addon-orders" type="hidden" name="orders">
                                <div  class="form-group" style="text-align:center; margin-top:30px; " >
                                    <button type="submit" class="btn btn-block">CHECK IN</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 0px"></div>
        </div>
    </div>
</div>
@push('js')

<script type="text/javascript">
    $(function(){
        if(typeof(Storage) !== 'undefined'){
            // localStorage.dt_arr = new Array; //never instantiate
            if(!localStorage.hasOwnProperty('dt_arr')){
                localStorage.setItem('dt_arr',JSON.stringify([]));
            }
            console.log("Local Storage activated");
        } else {
            $('#checkInForm').find('.modal-footer').html('<p id="store-warning" class="text-warning">Browser Storage is not supported for this browser.</p>');
        }
        var datatable = $('#addon_table').DataTable({
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
                        return '<input style="width:40px;" type="text" value="'+r.quantity+'"">';
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

        $('#checkInForm').find('#item_search').on('keyup',function(){
            if(searchedProduct.data == null){
                searchedProduct.search_data();
            }
            input = $(this);
            menu = $('#checkInForm').find('#searched-items');
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
                    .html(obj.key()); /*Brand*/
                menu.append(li);
                items.forEach(item=>{
                    li = $('<li/>')
                        .addClass("list-group-item")
                        .on('click',function(){
                            datatable.row.add(item).draw();
                        })
                        .html(item.name);
                    menu.append(li);
                });
            });
        });
        //Remove item
        $('#addon_table tbody').on( 'click', 'i.fa-times', function () {
            datatable
                .row( $(this).parents('tr') )
                .remove()
                .draw();
        } )
        //Edit item
        $('#addon_table tbody').on('keyup',"input",function(){
            row = datatable.row($(this).parents('tr')).data()
            row.quantity = $(this).val()
            row.amount = (row.price * row.quantity).toFixed(2)
            datatable.row($(this).parents('tr')).data(row)
            datatable.draw()
        });

        var RoomModal = {
            d : {!! $available !!},
            opened_id : '',
            roomdata(){
                return this.d.find(o=> o.code == this.opened_id)
            } ,
            addonsTotal(){
                data = datatable.column(5).data();
                if(data.length>0)
                    return data.reduce((a,b)=> (parseFloat(a) + parseFloat(b)));
                return 0;
            },
            getData(room_code, index = false){
                //find room_code on localStorage
                local = JSON.parse(localStorage.getItem('dt_arr'));
                i = local.findIndex(obj => {
                    return obj.room_code == room_code
                });

                if(index) {  return i;  }
                if(i>0){  return local[i];  } 

                return false;
            },
            saveData(room_code){
                function store(room_code,data){
                    return {
                        room_code : room_code,
                        dt : data
                    }
                }
                local = JSON.parse(localStorage.getItem('dt_arr'));
                index = this.getData(room_code, true);
                tddata = this.tabledata()
                if(index >= 0){
                    local[index] = store(room_code, tddata)
                } else {
                    local.push(store(room_code, tddata))
                }
                localStorage.dt_arr = JSON.stringify(local);
            },
            changeAddonTotal(){
                $('#addon_total').empty().val(parseFloat(this.addonsTotal()).toFixed(2))
            },
            tabledata(){
                return datatable.rows().data().toArray();
            },
            change() {
                form = $('#bookingform');
                data = this.roomdata();
                form.attr("action", "room/"+data.code+"/booking/checkin");
                //change rates
                roomratesSelect = form.find('#room-rates option');
                rates = data.rates[0]; //Rate conditions here
                roomratesSelect.each(function(key, option){
                    tag = $(option).data('tag')
                    $(option).val( parseFloat( rates[tag] ) );
                    $(option).text( tag + ': ' +parseFloat( rates[tag] ) );
                    if(tag == 'ST'){
                        $(option).prop('selected', true);
                    }
                });
                rate_type = form.find('#rate_type');
                rate_type.val(form.find('#room-rates').find(":selected").data('tag'))
            },
            postChange(){
                $('#addon-orders')
                    .attr('value', JSON.stringify(this.tabledata()));
            },
            changeTotalAmount(){
                let br = $('#bookingform').find('#room-rates').val();
                let total = parseFloat(br) + parseFloat(this.addonsTotal());
                let sc = document.getElementById('sc_priviledge');
                if(sc.checked){
                    total -= (total * 0.2);
                }
                let val = (total).toFixed(2)
                $('#checkInForm').find("input[name='total_amount']")
                    .val(val)
            }
        }

        datatable.on('draw', function() {
            RoomModal.changeAddonTotal()
            RoomModal.changeTotalAmount()
            RoomModal.postChange()
        });

        $('#checkInForm').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            RoomModal.opened_id = button.data('room') // Extract info from data-* attributes
            var roomnumber = button.data('name')
            modal = $(this);

            modal.find('.modal-title').text('Room: ' + roomnumber)
            roomdata = RoomModal.getData(RoomModal.opened_id);

            datatable.clear()
            if(roomdata){
                datatable.rows.add(roomdata.dt)
                datatable.draw()
            }
            RoomModal.change();
            // Set Addontotal
            RoomModal.changeAddonTotal();
            RoomModal.changeTotalAmount()
            //Optional Checkboxes
            modal.find('.checkbox input').on('change', function(){
                RoomModal.changeTotalAmount()
                dq = modal.find('#discount');
                target = modal.find($(this).data('hide'));
                console.log($(this).attr('id'));
                if(this.checked){
                    target.show();
                    if($(this).attr('id') == 'sc_priviledge')
                        dq.show();
                } else {
                    target.hide();
                    if($(this).attr('id') == 'sc_priviledge')
                        dq.hide();
                }
            });

            modal.find('#room-rates').on('change', function(){
                RoomModal.changeTotalAmount()
                modal.find('#rate_type').val($(this).find(':selected').data('tag'))
            });

            modal.find('#cashReceived').on("keyup",function(){
                change = $(this).val() - modal.find('#totalAmount').val();
                modal.find('#change').val(parseFloat(change).toFixed(2));
            });

            modal.find('#bookingform').on('submit', function(event){
                modal.find('#message').html('');
                change = modal.find('#change').val()
                plate = modal.find('#plate');
                driver = modal.find('#driver')
                if(plate.val() != '' && driver.val() == ''){
                    modal.find('#message').html('Missing Driver');
                    return false;
                }
                if( change >= 0){
                    return true;
                } else {
                    modal.find('#message').html('Insufficient Amount');
                    return false;
                }
            });
        }).on('hide.bs.modal', function(event){
            document.getElementById('sc_priviledge').checked = false;
            if(RoomModal.opened_id != ''){
                RoomModal.saveData(RoomModal.opened_id)
            }
        });
    });
</script>
@endpush