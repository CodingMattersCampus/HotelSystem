@if($cleaning->count() > 0)
<div id="cleaning-rooms" class="row-fluid">
    @foreach($cleaning as $room)
        <div class="col-md-2">
            <div class="box box-primary box-solid collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$room->name}}&nbsp;</h3>
                    <div class="box-tools pull-right">
                        <form method="POST" action="{{ route('booking.room.cleaned', compact('room'))}}">
                            @csrf
                            <button type="submit" class="btn btn-sm" style="color:green;"><i class="fa fa-check-square-o">&nbsp;</i>CLEANED</button>
                        </form>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    @endforeach
    <div class="clearfix"><div class="divider"><hr></div> </div>
</div>
@endif
