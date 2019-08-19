@extends('adminlte::page')
@section('content')
<div id="app" class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <form method="post" action="{{ \route('booking.taxis.create') }}">
                @csrf
                <div class="form-group {{ $errors->has('plate') ? 'has-error' : '' }}">
                    <label for="#plate">Plate #:</label>
                    <input type="text" id="plate" name="plate" placeholder="Plate No: ABC-123" class="form-control">
                    @if ($errors->has('plate'))
                        <span class="text-warning">{{ $errors->first('plate') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="#name">Driver's Name:</label>
                    <input type="text" id="name" name="name" placeholder="John Doe" class="form-control">
                    @if ($errors->has('name'))
                        <span class="text-warning">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('make') ? 'has-error' : '' }}">
                    <label for="#make">Maker (Brand):</label>
                    <input type="text" id="make" name="make" placeholder="Toyota" class="form-control">
                    @if ($errors->has('make'))
                        <span class="text-warning">{{ $errors->first('make') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('model') ? 'has-error' : '' }}">
                    <label for="#model">Model:</label>
                    <input type="text" id="model" name="model" placeholder="Civic" class="form-control">
                    @if ($errors->has('model'))
                        <span class="text-warning">{{ $errors->first('model') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('color') ? 'has-error' : '' }}">
                    <label for="#color">Color:</label>
                    <input type="text" id="color" name="color" placeholder="White" class="form-control">
                    @if ($errors->has('color'))
                        <span class="text-warning">{{ $errors->first('color') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" data-toggle="modal" class="btn btn-block btn-primary form-control"><i class="fa fa-plus">&nbsp;</i>New Taxi</button>
                </div>
            </form>
        </div>
        <div class="col-md-10">
            <div class="card bg-gray-light">
                <div class="row-fluid">
                    <div class="box box-primary collapsed-box">
                        <div class="box-header">
                            <h3 class="box-title">Taxi Listing</h3>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <table id="taxi-table" class="table table-responsive table-striped table-hover">
                        <thead class="bg-purple-gradient">
                        <tr>
                            <th>Plate #</th>
                            <th>Driver's Name</th>
                            <th>Maker</th>
                            <th>Model</th>
                            <th>Car Color</th>
                        </tr>
                        </thead>
                    </table>
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

    <script type="text/javascript">
        $(document).ready(function(){
            const table = $('#taxi-table').DataTable({
                "dom": 'Bfrtip',
                "buttons": ['pageLength', 'pdf', 'csv'],
                "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
                "serverSide": true,
                "deferRender": true,
                "columns": [
                    { "data": "plate", searchable: true, orderable: true },
                    { "data": "driver", searchable: true, orderable: false },
                    { "data": "make", searchable: true, orderable: false },
                    { "data": "model", orderable: false, searchable: true },
                    { "data": "color", orderable: false, searchable: true },
                ],
                "ajax": "{{\route('booking.api.taxis.all')}}"
            });

            $('#taxi-table tbody').on('click', 'tr', function () {
                const data = table.row( this ).data();
                window.location.href = ""+ data['plate'] +"/profile";
            });
        })
    </script>
@endpush