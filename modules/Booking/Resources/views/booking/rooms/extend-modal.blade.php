<!-- Modal -->
<div class="modal fade " id="extend-modal" role="dialog">
<div class="modal-dialog  modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header" style="background-color:rgb(60, 141, 188); color:white; padding: 5px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="col-md-12">
                <h3 class="modal-title">Extend Room #:</h3>
                <label for="#time_consumed">Time Consumed:</label>                              
            </div>
        </div>
        <div class="modal-body " style="color:black;">
            <form id="extendForm" role="form" method="post">
                @csrf
                <label>Select</label>
                <div class="input-group form-group" >
                    <select class="form-control" name="hours" id="hours">
                        <option value='1' selected>1 hour</option>
                        <option value="2">2 hours</option>
                        <option value="3">3 hours</option>
                        <option value="4">4 hours</option>
                        <option value="5">5 hours</option>
                        <option value="6">6 hours</option>
                        <option value="7">7 hours</option>
                        <option value="8">8 hours</option>
                        <option value="12">12 hours</option>
                        <option value="24">1 day</option>
                    </select>
                    <span class="input-group-addon" id="total_amount">Price</span>
                    <input type="hidden" name="total_amount" id="tph" value="0">
                </div>
                <div class="form-group">
                    <label>Payment</label>
                    <input class='form-control' type="text" name="payment" id="payment" value="0">
                </div>
                <div class="form-group">
                    <label>Change</label>
                    <input class='form-control' type="text" name="change" id="change" readonly value="0">
                </div>
                <span id="message"></span>
                <button type="submit" class="btn btn-block btn-info" style="margin-top: 25px">Extend</button>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Modal for adding Orders -->
@push('js')
<script type="text/javascript">
$(document).ready(function(){
    $('#extend-modal').on('shown.bs.modal', function(event){
        var button = $(event.relatedTarget) // Button that triggered the modal
        roomname = button.data('name')
        roomclicked = button.data('room') // Extract info from data-* attributes
        modal = $(this)
        form = modal.find('#extendForm')
        //inputs
        paymentInput = form.find('#payment');
        changeInput = form.find('#change');
        tphInput = form.find('#tph');

        //messages
        hours = form.find('#hours');
        message = form.find('#message');

        modal.find('.modal-title').html('Extend Room '+roomname);
        //on Change
        hours.on('change', changeFunc);
        hours.on('keyup', changeFunc);
        hours.on('focus', changeFunc);
        function changeFunc(e){
            value = e.currentTarget.value * 60;
            form.find('#total_amount').html("Total: " + value.toFixed(2));
            tphInput.val(value);
        }

        paymentInput.on('keyup', function(e){
            value = parseFloat($(this).val()) - parseFloat(tphInput.val());
            changeInput.val(value.toFixed(2));
        });
    
        form.attr('action', "room/"+roomclicked+"/booking/extend");

        form.on('submit', function(){
            if(tphInput.val() <= 0 ){
                message.html('Not Extended');
                return false;
            }
            if(paymentInput.val() <= 0){
                message.html('No Payment received');
                return false;
            }
            if(changeInput.val() < 0){
                message.html('Insufficient Value');
                return false;
            }
            return true;
        });

    });
});
</script>
@endpush