@if($others->count() > 0)
<div id="other-rooms" class="row-fluid">
    @foreach($others as $room)
            <div class="col-md-2">
                    @if('maintenance' === $room->status)
                    <div class="box box-default box-solid collapsed-box">
                        @elseif('cleaning' === $room->status)
                            <div class="box box-primary box-solid collapsed-box">
                                @endif
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{$room->name}}&nbsp;</h3>
                                    <div class="box-tools pull-right">
                                        @if('maintenance' === $room->status)
                                            <form method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check-square-o">&nbsp;</i>DONE</button>
                                            </form>
                                        @elseif('cleaning' === $room->status)
                                            <form method="POST" action="{{ route('booking.room.cleaned', compact('room'))}}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check-square-o">&nbsp;</i>DONE</button>
                                            </form>
                                        @endif
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                            </div>
                    </div>
            </div>
    @endforeach
    <div class="clearfix"><div class="divider"><hr></div>
</div>
@endif