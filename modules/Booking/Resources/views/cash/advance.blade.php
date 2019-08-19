@extends('adminlte::page')
@section('content')
<div id="app" class="">
    <div class="row">
        <div class="col-md-3">
            <form id="advance" action="{{ route('booking.cash.advance.withdraw') }}" method="POST">
                @csrf
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cash Advance</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('employee') ? 'has-error' : '' }}">
                            <label for="#employee">Employee: </label>
                            <div class="dropdown">
                                <input type="text" id="employee" name="employee" class="form-control" data-toggle="dropdown" autocomplete="off" required>
                                <ul id="employee_names" class="dropdown-menu list-group" style="width: 100%; margin: 0px; padding: 0px" aria-labelledby="employee"></ul>
                            </div>
                            <input type="hidden" id="employee_code" name="employee_code" required>
                            @if ($errors->has('employee'))
                                <span class="text-warning">{{ $errors->first('employee') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('reason') ? 'has-error' : '' }}">
                            <label for="#reason">Compelling Reason:</label>
                            <textarea id="reason" name="reason" class="form-control" required=""></textarea>
                            @if ($errors->has('reason'))
                                <span class="text-warning">{{ $errors->first('reason') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('advance_amount') ? 'has-error' : '' }}">
                            <label for="#advance_amount"> Amount to Take:</label>
                            <input type="number" id="advance_amount" name="advance_amount" class="form-control" required="">
                            @if ($errors->has('advance_amount'))
                                <span class="text-warning">{{ $errors->first('advance_amount') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="box-tools pull-right">
                            <button class="btn btn-block btn-primary" type="submit" id="submit">Take Cash Advance</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-9">
            @if($message = session('success'))
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> {{ $message['msg'] }}!</h4>
                    {{ $message['text'] }}
                </div>
            @endif

            <div class="card bg-gray-light">
                <div class="row-fluid">
                    <div class="box box-primary collapsed-box">
                        <div class="box-header">
                            <h3 class="box-title">Approved Cash Advance</h3>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <table id="advance-table" class="table table-responsive table-striped table-hover">
                        <thead class="bg-purple-gradient">
                        <tr>
                            <th>ID</th>
                            <th>Transaction</th>
                            <th>Requested By</th>
                            <th>Requested At</th>
                            <th>Amount</th>
                            <th>Approval</th>
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
@endsection
@section('css')
    <meta name="csrf-token" content="{{@csrf_token()}}">
@endsection
@push('js')
    <script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
    var employees = {
        d: [],
        getEmployees(){
            $.get("{{route('booking.api.employees.all')}}", function(response){
                employees.d = response;
            });
        },
        findEmployee(string){
            return Enumerable.from(this.d)
                .where(function(output){
                    if (String(output['fullname']).toLowerCase().indexOf(string.toLowerCase()) !== -1)
                        return true;
                }).toArray();
        }
    }
    $(function(){
        if(employees.d.length == 0){
            employees.getEmployees();
        }
        $('#employee').on('keyup', function(){
            input = $(this);
            dropdown = $(this).parent();
            output = employees.findEmployee($(this).val());
            menu = dropdown.find('#employee_names');
            employeeCodeInput = dropdown.parent().find('#employee_code');
            console.log(output);
            menu.html('');
            output.forEach(function(employee){
                console.log('employee', employee);
                li = $('<li/>')
                    .addClass("list-group-item")
                    .on('click',function(){
                        employeeCodeInput.val(employee.code);
                        input.val(employee.fullname);
                    })
                    .html(employee.fullname); /*Brand*/
                    menu.append(li);
            });
        });

        const table = $('#advance-table').DataTable({
                "dom": 'Bfrtip',
                "buttons": ['pageLength', 'pdf', 'csv'],
                "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
                "serverSide": true,
                "deferRender": true,
                "columns": [
                    { "data": "id", searchable: true, orderable: true },
                    { "data": "transaction", searchable: true, orderable: false },
                    { "data": "employee", searchable: true, orderable: false },
                    { "data": "created_at", orderable: false, searchable: true },
                    { "data": "amount", orderable: false, searchable: true },
                    { "data": "approve", orderable: false, searchable: true, render(d,t,r){
                        if(r.approval == 'approved') 
                            return '<span class="label label-success">'+ r.approval +'</span>';
                        else if( r.approval == 'rejected')
                            return '<span class="label label-warning">'+ r.approval+'</span>';
                        return '<span class="label label-info">' + r.approval + '</span>'
                    } },
                    { "data": "cashier", orderable: false, searchable: true },
                    { "data": "updated_at", orderable: false, searchable: true },
                ],
                "ajax": "{{\route('booking.api.cash.advance.approved')}}"
            });
    });
    </script>
@endpush