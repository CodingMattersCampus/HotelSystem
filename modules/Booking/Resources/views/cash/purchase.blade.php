@extends('adminlte::page')
@section('content')
<div id="app" class="">
    <div class="row">
        <div class="col-md-3">
            <form id="advance" action="{{ route('booking.cash.deduct.purchases') }}" method="POST">
                @csrf
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">On-demand Purchases</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                            <label for="#amount"> Amount:</label>
                            <input type="number" id="amount" name="amount" class="form-control" required="">
                            @if ($errors->has('amount'))
                                <span class="text-warning">{{ $errors->first('amount') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('reason') ? 'has-error' : '' }}">
                            <label for="#reason">Reason:</label>
                            <textarea id="reason" name="reason" class="form-control" required=""></textarea>
                            @if ($errors->has('reason'))
                                <span class="text-warning">{{ $errors->first('reason') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="box-tools pull-right">
                            <button class="btn btn-block btn-primary" type="submit" id="submit">Record</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-9">
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
    });
    </script>
@endpush