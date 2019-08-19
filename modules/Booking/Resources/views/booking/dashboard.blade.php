@extends('adminlte::page')
@section('content')
    <div id="app" class="row">
        @include('booking::booking.rooms.occupied', $occupied)
        @include('booking::booking.rooms.cleaning', $cleaning)
        @include('booking::booking.rooms.available', $available)
        @include('booking::booking.rooms.maintenance', $maintenance)
    </div>
@endsection
@section('css')
    <meta name="csrf-token" content="{{@csrf_token()}}">
@endsection
@push('js')
    <script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        var searchedProduct = {
            data: null,
            search_data(){
                $.ajax({
                    url: "{{\route('booking.products.orderable')}}",
                    method: 'get',
                    async: false,
                    success:function(d){
                        searchedProduct.data = d;
                    }
                });
            },
            query(string, concern = null, groupBy=''){
                ret = Enumerable.from(this.data)
                    .where(function(output){
                        if(concern.searchable.length > 0){
                            for (var i = 0; i < concern.searchable.length; i++) {
                                if (String(output[concern.searchable[i]]).toLowerCase().indexOf(string.toLowerCase()) !== -1)
                                    return true;
                            }
                        }
                        for (var key in output) {
                            if (String(output[key]).toLowerCase().indexOf(string.toLowerCase()) !== -1)
                                return true;
                        }
                    })
                    //how to modify this?
                    .groupBy(function(obj){
                        return obj['brand'];
                    });

                return ret.toArray();
            }
        };
        
        $(document).ready(function(){

            $('#bookingform').validate();

            $(document).on('click','#submit', function(){
                document.getElementById('#password,#passwordConfirm,currentpassword').value = '';
            })
        });

        // fetch updates every 5 minutes
        setInterval( function () {
            location.reload();
        }, 300000 );
    </script>
@endpush