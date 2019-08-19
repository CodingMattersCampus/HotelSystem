@if($available->count() > 0)
    <div id="available-rooms" class="row-fluid">
        @foreach($available as $room)
            <div class="col-md-2">
                <div class="box box-success box-solid collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$room->name}}&nbsp;</h3>
                        <div class="box-tools pull-right">
                            <button data-toggle="modal" data-target="#checkInForm" data-name="{{$room->name}}" data-room="{{$room->code}}" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check">&nbsp;</i>CHECK IN</button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        @endforeach

        @include('booking::booking.rooms.booking-modal') 
        <div class="clearfix"><div class="divider"><hr></div> </div>
    </div>
@endif
