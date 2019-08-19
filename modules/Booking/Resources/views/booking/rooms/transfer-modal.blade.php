<!-- Modal -->
<div class="modal fade " id="transfer-modal" role="dialog">
<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header" style="background-color:rgb(60, 141, 188); color:white; padding: 5px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="col-md-12">
                <h3 class="modal-title">Transfer Room #:</h3>
            </div>
        </div>
        <div class="modal-body " style="color:black;">
            <form id="transferForm" role="form" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Current Book Paid</label>
                            <input class='form-control' type="text" name="current" id="current" readonly value="350">
                        </div>
                        <div class="form-group" >
                            <label>Available Rooms</label>
                            <select class="form-control" id="rooms">
                                <option disabled selected><em>Select Room</em></option>
                                {{-- //change date-time to dynamic function. used static atm.  --}}
                                @forelse( $available as $room)
                                    <optgroup label="Room {{strtoupper($room->name)}} : {{ucfirst($room->type)}}">
                                        <option data-room="{{ $room->code }}"
                                                value="{{ $room->getRates()['ST'] }}"
                                                data-time="3">{{strtoupper($room->name)}}: Short Time (3Hrs)</option>
                                        <option data-room="{{ $room->code }}"
                                                value="{{ $room->getRates()['HD'] }}"
                                                data-time="12">{{strtoupper($room->name)}}: Half Day (12Hrs)</option>
                                        <option data-room="{{ $room->code }}"
                                                value="{{ $room->getRates()['WD'] }}"
                                                data-time="24">{{strtoupper($room->name)}}: Whole Day (24Hrs)</option>
                                    </optgroup>
                                @empty
                                    <option disabled>No available room</option>
                                @endforelse
                            </select>
                            <input type="hidden" name="room" id="selected-room">
                            <input type="hidden" name="reset-time" id="reset-time">
                        </div>
                        <div class="form-group" >
                            <label>Booking Rate</label>
                            <input id="booking-rate" type="text" class="form-control" name="booking-rate" readonly>
                        </div>
                        <div class="form-group" >
                            <label>Payable Difference</label>
                            <input type="text" class="form-control" name="total_amount" id="total_amount" readonly value='0'>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Reason: </label>
                            <textarea class="form-control" name="reason" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Payment</label>
                            <input class='form-control' type="text" name="cash" id="cash" value="0">
                        </div>
                        <div class="form-group">
                            <label>Change</label>
                            <input class='form-control' type="text" name="change" id="change" readonly value="0">
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger text-xs">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <span id="message"></span>
                <button type="submit" class="btn btn-block btn-info" style="margin-top: 25px">Transfer</button>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Modal for adding Orders -->
@push('js')
<script type="text/javascript">

$(document).ready(function(){
    $('#transfer-modal').on('shown.bs.modal', function(event){
        var button = $(event.relatedTarget) // Button that triggered the modal
        roomname = button.data('name')
        roomclicked = button.data('room') // Extract info from data-* attributes
        modal = $(this)
        form = modal.find('#transferForm')
        //inputs
        paymentInput = form.find('#cash');
        changeInput = form.find('#change');
        current = modal.find('#current');
        newRate = modal.find('#booking-rate');
        total_amount = modal.find('#total_amount');

        //messages
        message = form.find('#message');
        //changes
        modal.find('.modal-title').html('Transfer Room '+roomname);
        form.attr('action', "room/"+roomclicked+"/booking/transfer");
        current.val( button.data('bookingrate'));
        //on Change
        modal.find('#rooms').on('change', function(e){
            option = $(this).find(':selected');
            room_code = option.data('room');
            new_timeout = option.data('time');
            room_rate = $(this).val();
            newRate.val( room_rate );
            modal.find('#reset-time').val( new_timeout );
            modal.find('#selected-room').val( room_code );
            total_amount_v = parseFloat(newRate.val()) - parseFloat(current.val());
            if(total_amount_v > 0){
                total_amount.val(total_amount_v);
            } else {
                total_amount.val(0.00);
            }
            paymentFunc();
        })

        function paymentFunc(){
            value = parseFloat(paymentInput.val()) - (total_amount.val());
            if(total_amount.val() < 0){
                changeInput.val(0);
                return;
            }
            if(value > 0){
                changeInput.val(value.toFixed(2));
            } else {
                changeInput.val(0);
            }
        }
        //Payment
        paymentInput.on('keyup', paymentFunc);

        form.on('submit', function(){
            if(newRate.val() <= 0){
                message.html('Selected No Room');
                return false;
            }
            if(total_amount.val() <= 0 && paymentInput.val() > 0){
                message.html('No Payment Required, please set 0');
                return false;
            }
            if(current.val() < newRate.val()){
                if(paymentInput.val() <= 0){
                    message.html('No Payment Received');
                    return false;
                }
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