@if($occupied->count() > 0)
    <div id="occupied-rooms" class="row-fluid">
        @foreach($occupied as $room)
            <div class="col-md-2">
                <div class="box box-danger box-solid">
                    <div class="box-header">
                        <div class="row-fluid">
                            <span class="pull-left text-bold">{{$room->name}}</span>
                            <div class="btn-group-xs pull-right">
                                <button data-toggle="modal" data-target="#order-modal" id="addorder_button" class="btn btn-sm btn-success" data-name="{{$room->name}}" data-room="{{$room->code}}"><i class="fa fa-shopping-cart"></i></button>
                                <button data-toggle="modal"  data-target="#extend-modal" id="extend_button" class="btn btn-sm btn-info" data-name="{{$room->name}}" data-room="{{$room->code}}"><i class="fa fa-clock-o"></i></button>
                                <button data-toggle="modal" data-target="#transfer-modal" id="transfer_button" class="btn btn-sm btn-warning" data-name="{{$room->name}}" data-bookingrate="{{ $room->getBookedRoomRate()}}" data-room="{{$room->code}}"><i class="fa fa-arrow-right"></i></button>
                                <button data-toggle="modal" data-target="#penalty-modal" id="checkout_button" class="btn btn-sm btn-default" data-name="{{$room->name}}" data-room="{{$room->code}}"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <div class="box-body no-border" style="padding: 0px">
                        <timer
                            :key="{{json_encode($room->code)}}"
                            :room='{!!json_encode($room->code)!!}'
                            :checkout='{!!json_encode($room->getTimeOut())!!}'
                            :time-remaining='{!!json_encode($room->getTimeRemaining())!!}'
                        ></timer>
                    </div>
                </div>
            </div>
        @endforeach
        @include('booking::booking.rooms.penalty-modal') 
        @include('booking::booking.rooms.extend-modal') 
        @include('booking::booking.rooms.orders-modal') 
        @include('booking::booking.rooms.transfer-modal') 

        <div class="clearfix"><div class="divider"><hr></div></div>
    </div>
@endif
@push('js')
<script type="text/javascript" src="{{ asset('vue/timer.js') }}"></script>
@endpush