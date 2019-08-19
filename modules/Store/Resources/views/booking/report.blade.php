@extends('adminlte::page')
@section('content')
<div class="container-fluid" id="app">
    <div class="row">
        @include('store::booking.booking-chart')
    </div>
   <div class="row">
        @include('store::booking.booking-table')
   </div>
    
</div>
@endsection
@push('css')
<meta name="csrf-token" content="{{@csrf_token()}}">
@endpush
@prepend('js')
<script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    // fetch updates every 1 hour
    const current = new Date;
</script>
@endprepend
@push('js')
<script type="text/javascript">
    setInterval( function () {
        table.ajax.reload();
        chartdata.getDataAjax(current.getMonth());
    }, 360000 );
</script>
@endpush