@if($maintenance->count() > 0)
    <div id="available-rooms" class="row-fluid">
        @foreach($maintenance as $room)
            <div class="col-md-2">
                <div class="box box-default box-solid collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$room->name}}&nbsp;</h3>
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
