<!-- Modal -->
<div class="modal fade " id="penalty-modal" role="dialog">
<div class="modal-dialog  modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header" style="background-color:rgb(60, 141, 188); color:white; padding: 5px;">
            <div class="col-md-4">
                <h3 class="modal-title"> Room #:</h3>
                <label for="#time_consumed">Time Consumed:</label>
            </div>                                
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body " style="color:black;">
            <form id="checkoutform" method="POST">
                @csrf
                <div class="col-md-8">
                    <div class="row" style="padding-left:10px; padding-right:25px;">
                        <h4 style="margin:0 0 5px 0;">Penalties</h4>
                        <div class="card" style="padding: 0 15px 0 0;">
                            <div class="row-fluid">
                                <div class="dropdown">
                                    <input type="text" id="penalty_search" data-toggle="dropdown" autocomplete="off" class="form-control" placeholder="Search Product" aria-label="Search Product">
                                    <ul id="searched-penalty" class="dropdown-menu list-group" style="width: 100%; margin: 0px;" aria-labelledby="penalty_search">
                                        <li class="list-group-item" disabled>Search Penalties</li>
                                    </ul>
                                </div>
                                <table id="penalty_table" class="table table-responsive table-striped table-condensed table-hover" style="width:100%">
                                    <thead class="bg-purple-gradient">
                                        <tr>                                              
                                            <th style="width:50%;">Name</th>
                                            <th style="width:25%;">Rate</th>
                                            <th style="width:25%;">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="base_tr">
                                            <td></td>
                                            <td class="rate"></td>
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
                            <div class="form-group">
                                <label for="password">Total Fee:</label>
                                <input style="border-radius:10px;" class="form-control" type="text" name="total_amount" id="totalFee" readonly  value="0"/>
                            </div>
                            <div class="form-group">
                                <label for="cash_received">Cash:</label>
                                <input style="border-radius:10px;" class="form-control" type="number" name="cash" id="cashreceived" value="0" required/>
                            </div>
                            <div  class="form-group">
                                <label for="passwordConfirm" id="passwordLabelConfirm">Change</label>
                                <input style="border-radius:10px;"  class="form-control" type="" name="change" id="cash_change" value="0" readonly placeholder="0" />
                                <span id="message"></span>
                            </div>
                            <div  class="form-group" style="text-align:center; margin-top:30px; " >
                                <button style="background-color:rgb(60, 141, 188); color: white; border:1px solid white;" type="submit" id="checkout_modal_button" class="btn btn-block">CHECK OUT</button>
                            </div>
                            <input type="hidden" name="penalties" id="penaltyset">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div style="border:1px solid white;" class="modal-footer"></div>
    </div>
</div>
</div>
<!-- Modal for adding Orders -->
@push('js')
<script type="text/javascript">
$(document).ready(function(){
    var penalty_dt = $('#penalty_table').DataTable({
        "dom": 't',
        "buttons": [],
        "deferRender": true,
        "columns": [
            { "data": "name", searchable: true, orderable: true },
            { "data": "rate", searchable: false, orderable: false },
            { "data": "remove", defaultContent: '<i class="fa fa-times text-red"></i>', "orderable": false, "searchable": false },
        ],
        data: [],
    });
    //reactive draw method on datatable
    penalty_dt.on('draw', function(){
        penaltyModal.generateFee()
    });
    //Remove item
    $('#penalty_table tbody').on( 'click', 'i.fa-times', function () {
        penalty_dt
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    } )

    var penaltyModal = {
        roomclicked: null,
        roomname: null,
        generateFee(){
            //Generate fee from table.
            data = penalty_dt.column(1).data(); //amount column
            dt = penalty_dt.rows().data(); //all data
            if(data.length>0){
                fee = data.reduce((a,b)=>parseInt(a)+parseInt(b))
                $('#penalty-modal').find('#totalFee').val(fee)
            } else {
                $('#penalty-modal').find('#totalFee').val(0)
            }

            change = modal.find('#cashreceived').val() - modal.find('#totalFee').val();
            modal.find('#cash_change').val(change);
            //collect dt data for form
            toForm = dt.toArray();
            //reset data
            $('#penalty-modal').find('#penaltyset')
                    .attr('value', JSON.stringify(toForm));
        },
        changeModalDetail(){
            modal = $('#penalty-modal')
            modal.find('.modal-title').html('Room #: ' + this.roomname)
            modal.find('#checkoutform').attr('action', "/room/" + this.roomclicked + "/booking/checkout");
        },
    }

    $('#penalty_search').on('keyup',function(){
        input = $(this);
        menu = $('#searched-penalty');
        string = input.val();
        menu.html('');
        $.ajax({
            'async': false,
            'type': "GET",
            'global': false,
            'dataType': "json",
            'url': "{{route('booking.api.penalties.all')}}",
            data: {
                search: string
            },
            success:function(d){
                if(d.length > 0){
                    items = d.slice(null, 5);
                    items.forEach(item=>{
                        li = $('<li/>')
                            .addClass("list-group-item")
                            .on('click',function(){
                                penalty_dt.row.add(item).draw();
                            })
                            .html("Penalty: "+item.name+"; Rate: "+item.rate+"");
                        menu.append(li);
                    });
                } else {
                    menu.html('<li class="list-group-item" disabled>Missing Penalty</li>');
                }
            }
        });
    });

    $('#penalty-modal').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        penaltyModal.roomname = button.data('name')
        penaltyModal.roomclicked = button.data('room') // Extract info from data-* attributes
        modal = $(this)

        penaltyModal.changeModalDetail();

        modal.find('#cashreceived').on("keyup",function(){
            change = $(this).val() - modal.find('#totalFee').val();
            modal.find('#cash_change').val(change);
        });

        modal.find('#checkoutform').on('submit', function(event){
            change = modal.find('#cash_change').val()
            if(modal.find('#totalFee').val() == 0 && modal.find('#cashreceived').val() > 0)
                return false;
            if(change && change >= 0){
                return true;
            } else {
                modal.find('#message').html('Insufficient Amount');
                return false;
            }
        });
    });
});
</script>
@endpush