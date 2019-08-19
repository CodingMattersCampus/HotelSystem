@extends('adminlte::page')

@push('css')
<meta name="csrf-token" content="{{@csrf_token()}}">
<!-- <link  rel="stylesheet" href="{{ \asset('css/profile.css') }}"> -->
<link rel="stylesheet" type="text/css" href="{{ \asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}">
<style type="text/css">
    .profile_information .list-group li {
        padding: 5px 20px;
        margin: 5px 0px;
        font-weight: bold;
        height: auto;
    }
    .profile_information .list-group li > span {
        font-weight: normal;
    }
    .profile_information .list-group li > span.editing {
        width: 60%;
    }
    .input-group span.input-group-btn button {
        font-size: 12px; 
        padding: 3px 6px;
        border: 1px solid rgb(0, 172, 214);
    }
</style>
@endpush

@section('content')
     
<div class="row" style="margin: 0;font-family: sans-serif;font-weight: 100;height:100%;width:100%">
    <div class="col-md-3">
        <div class="box" style=" box-shadow: 0 0 15px  rgb(0,0,0,0.2); border-top-left-radius:10px;  border-top-right-radius:10px;" >
            <div class="box-body box-profile">
                <div class="profile_image" data-toggle="modal" data-target="#profile-photo">
                    <img src="{{ $employee->profilePhoto() }}" class="profile-user-img img-responsive img-circle" alt="jigs" width="40%" > 
                </div>
                @include('office::employee.profile-photo')
                @include('office::employee.edit-personal')
                <div class="profile_information">
                    <h4 class="profile-username text-center text-primary" data-toggle="modal" data-target="#profile-personal">{{ $employee->fullname }}</h4>
                    <h5 class="text-muted text-center ">{{ ucfirst($employee->role) }}</h5>
                    <h6 class="text-muted text-center">{{ $employee->dateofbirth }}</h6>
                    <ul class="list-group" style="list-style: none;">
                        <li data-for="contact_number">Contact: <span class="pull-right" data-value="09756102690/224-5123">09756102690/224-5123</span></li>
                    </ul>
                    <hr style="background-color:rgb(0,0,0);">
                    <ul class="list-group" style="list-style: none;">
                        <li data-for="sss">SSS 
                            <span class="pull-right" data-value="{{$employee->sss}}"> 
                                {{ ($employee->sss) ?: 'No Entry' }}
                            </span>
                        </li>
                        <!-- <li>GSIS <span class="pull-right" data-value="{{$employee->tin}}"> {{ ($employee->tin) ?: 'No Entry' }}</span></li> -->
                        <li data-for="philhealth">PhilHealth 
                            <span class="pull-right" data-value="{{$employee->philhealth}}"> 
                                {{ ($employee->philhealth) ?: 'No Entry' }}
                            </span>
                        </li>
                        <li data-for="hdmf">Pag-Ibig 
                            <span class="pull-right" data-value="{{$employee->hdmf}}">
                                {{ ($employee->hdmf) ?: 'No Entry' }}
                            </span>
                        </li>
                    </ul>
                    @csrf
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="nav-tabs-custom" style=" box-shadow: 0 0 15px  rgb(0,0,0,0.2); " >
            <ul class="nav nav-tabs">   
                <li class="active">
                    <a href="#attendance" data-toggle="tab" aria-expanded="true">Attendance</a>
                </li>
                <li class="">
                    <a href="#payroll" data-toggle="tab" aria-expanded="false">Payroll</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="attendance">
                    <table id="attendance-table" class="table table-condensed table-striped dataTable no-footer" style="width:100%">
                        <thead class="bg-purple-gradient">
                            <th>Attendance Date</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Updated on</th>
                        </thead>
                    </table>
                </div>
                <div class="tab-pane" id="payroll">
                    <div class="card bg-gray-light">
                        <div class="row-fluid">
                            <div class="box box-primary collapsed-box">
                                <div class="box-header">
                                    <h3 class="box-title">Cash Advances</h3>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <table id="advance-table" class="table table-responsive table-striped table-hover" style="width: 100%">
                                <thead class="bg-purple-gradient">
                                    <tr>
                                        <th>ID</th>
                                        <th>Transaction</th>
                                        <th>Requested At</th>
                                        <th>Amount</th>
                                        <th>Approval</th>
                                        <th>Given</th>
                                        <th>Approved By</th>
                                        <th>Approved At</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ \asset('vendor/jquery-validation/js/jquery-validate.js') }}"></script>
<script src="{{ \asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
    $(function(){
        $('.profile_information ul').on('dblclick', 'li span', function(e){
            span = $(this);
            li = span.parent();
            value = span.data('value');
            tag =  li.data('for');
            obj = {};
            obj._token = "{{ @csrf_token() }}";
            
            function send(d){
                if(d == value){
                    span.data('value', d);
                    span.html(d);
                } else {
                    if(d != '' && value != null){
                        obj[tag] = d;
                        $.ajax({
                            url: "{{ route('office.employee.record.edit', compact('employee')) }}",
                            method: 'post',
                            async: false,
                            dataType: 'json',
                            data: obj,
                            success(res){
                                span.data('value', d);
                                span.html(d);
                            }
                        });
                    } else {
                        span.data('value', value);
                        span.html(value);
                    }
                }
                span.removeClass('editing');
            }

            if(!span.hasClass('editing')) {
                span.html(''); //clear inside
                span.addClass('editing');
                _div = $('<div />').addClass('input-group input-group-sm')
                _input = $('<input />').addClass('form-control').val(value);
                _button = $('<button />')
                    .addClass('btn btn-info btn-flat')
                    .on('click', function (e){
                        send(_input.val());
                    })
                    .html("<i class='fa fa-edit'></i>");
                _span = $('<span/>').addClass("input-group-btn").append(_button);
                _div.append(_span);
                _div.append(_input)
                span.append(_div);
            }

        });

        $('#attendance-table').DataTable({
            "dom": 'Bfrtip',
            "buttons": ['pageLength', 'pdf', 'csv'],
            "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
            "serverSide": true,
            "deferRender": true,
            "columns": [
                { "data": "for_date", searchable: true, orderable: true },
                { "data": "in", orderable: false, searchable: true },
                { "data": "out", orderable: false, searchable: true },
                { "data": "updated_at", orderable: false, searchable: true },
            ],
            "ajax": {
                "url": "{{\route('api.office.employee.attendance.all', compact('employee'))}}",
                "method": "POST",
                "data": {
                    "api_token": "{{ $token }}",
                },
            }
        });

        $('#advance-table').DataTable({
            "dom": 'Bfrtip',
            "buttons": ['pageLength', 'pdf', 'csv'],
            "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
            "serverSide": true,
            "deferRender": true,
            "columns": [
                { "data": "id", searchable: true, orderable: true },
                { "data": "transaction", searchable: true, orderable: false },
                { "data": "created_at", orderable: false, searchable: true },
                { "data": "amount", orderable: false, searchable: true },
                { "data": "approve", orderable: false, searchable: true, render(d,t,r){
                    if(r.approval == 'approved') 
                        return '<span class="label label-success">'+ r.approval +'</span>';
                    else if( r.approval == 'rejected')
                        return '<span class="label label-warning">'+ r.approval+'</span>';
                    return '<span class="label label-info">' + r.approval + '</span>'
                } },
                { "data": "given", searchable: true, orderable: false , render(d,t,r){
                    if(r.given) 
                        return '<span class="label label-success">Given</span>';
                    else
                        return '<span class="label label-warning">On Cashier</span>';
                } },
                { "data": "cashier", orderable: false, searchable: true },
                { "data": "updated_at", orderable: false, searchable: true },
            ],
            "ajax": {
                "url": "{{\route('api.cash.advance.employee', compact('employee'))}}",
                "method": "POST",
                "data": {
                    "api_token": "{{ $token }}",
                },
            }
        });
    });
</script>
@endpush