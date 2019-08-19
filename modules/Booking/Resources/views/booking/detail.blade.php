@extends('adminlte::page')
@section('content')
<div id="app" class="container-fluid">
    <h3>{{ $room->name }}</h3>
</div>
@endsection
@section('css')
    <meta name="csrf-token" content="{{@csrf_token()}}">
@endsection
@push('js')
    <script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>
@endpush