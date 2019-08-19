@extends('adminlte::page')
@section('content')
<div id="app" class="row">
<div class="col-md-3">
    <div class="box box-solid  box-primary">
        <div class="box-header with-border">
            <h2 class="box-title">{{ strtoupper($taxi->plate) }}</h2>
        </div>
        <div class="box-body">
            <div class="row text-center">
                {{ $taxi->driver }}
            </div>
        </div>
    </div>
</div>
<div class="col-md-9">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#settings" data-toggle="tab" aria-expanded="true">Settings</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="settings">
                <div class="container-fluid">
                    <form>
                        <div class="row">
                            <div class="col-md-5">
                                PHOTO HERE
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="#driver">Driver:</label>
                                    <input class="form-control" type="text" value="{{$taxi->driver}}" id="driver" name="driver">
                                </div>
                                <div class="form-group">
                                    <label for="#mobile">Cellphone:</label>
                                    <input class="form-control" type="text" id="mobile" name="mobile">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-block btn-primary"><i class="fa fa-save">&nbsp;</i>Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('css')
    <meta name="csrf-token" content="{{@csrf_token()}}">
@endsection
@push('js')
    <script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>
@endpush