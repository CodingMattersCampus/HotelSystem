<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div id="create_employee" class="small-box bg-yellow" data-toggle="modal" data-target="#create_employee_modal">
        <div class="inner">
            <h3>44</h3>
            <p>New Hires</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer"><i class="fa fa-plus-circle">&nbsp;</i>Add New Employee</a>
    </div>
</div>
<!--  -->
        <!-- Modal -->
<div id="create_employee_modal" class="modal fade" role="dialog" >
    <div class="modal-dialog">
            <!-- Modal content-->
        <div class="modal-content" style="border-radius:10px;">
            <div class="modal-body" >
                <form id="employee-form" method="POST" action="{{ route('store.employee.record.create') }}" style="width:100%; display:block; background:white;">
                    @csrf
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title text-bold text-center">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        Personal Information
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body" style="padding: 20px 30px">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="#role">Role:</label>
                                            <select  class="form-control"  name="role" id="role"  style="border-radius:10px; padding:8px; border:1px solid rgb(217, 221, 227);">
                                                @foreach($roles as $role)
                                                    <option value="{{strtolower($role)}}"> {{$role}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group {{ $errors->has('date_employed') ? 'has-error' : '' }}">
                                            <label for="#date_employed">Date employed <i class="text-danger">*</i> :
                                                @if ($errors->has('date_employed'))
                                                    <span class="text-warning">{{ $errors->first('date_employed') }}</span>
                                                @endif
                                            </label>
                                            <input  placeholder="Date" class="form-control" type="text" id="date_employed" name="date_employed" class="hasDatepicker" style=" border-radius:10px; border:1px solid rgb(217, 221, 227); padding:8px" required>
                                            <div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                                        <label for="#first_name">First Name <i class="text-danger">*</i> :
                                            @if ($errors->has('first_name'))
                                                <span class="text-warning">{{ $errors->first('first_name') }}</span>
                                            @endif
                                        </label>
                                        <input  style="border-radius:10px;"  type="text" class="form-control" id="first_name" name="first_name" placeholder="Given Name" required minlength="1">
                                    </div>
                                    <div class="form-group {{ $errors->has('middle_name') ? 'has-error' : '' }}">
                                        <label for="#middle_name">Middle Name: <small class="text-muted">(Optional)</small></label>
                                        <input  style="border-radius:10px;" type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" minlength="1">
                                        @if ($errors->has('middle_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('middle_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                        <label for="#last_name">Last Name <i class="text-danger">*</i> :
                                                @if ($errors->has('last_name'))
                                                    <span class="text-warning">{{ $errors->first('last_name') }}</span>
                                                @endif
                                            </label>
                                        <input  style="border-radius:10px;" type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required minlength="1">
                                    </div>
                                    <div class="form-group">
                                        <label for="#last_name">Suffix:</label>
                                        <select style="background-color:white;border-radius:10px;padding:8px;" id="suffix" class="btn btn-sm btn-default form-control" >
                                            <option id="alias" value="jr"> Suffix: Ex JR, SR. etc.</option>
                                            <option id="alias1" value="jr">Jr </option>
                                            <option id="suffix2" value="sr">Sr</option>
                                            <option id="suffix3" value="ii">II</option>
                                            <option id="suffix4" value="iii">III</option>
                                            <option id="suffix5" value="iv">IV</option>
                                            <option id="suffix6" value="v">V</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group {{ $errors->has('birthdate') ? 'has-error' : '' }}">
                                            <label for="#birthdate">Birth Date <i class="text-danger">*</i> :
                                            @if ($errors->has('birthdate'))
                                                <span class="text-warning">{{ $errors->first('birthdate') }}</span>
                                            @endif
                                            </label>
                                            <input  placeholder="Date" class="form-control" type="text" id="birthdate" name="birthdate"  style=" border-radius:10px; border:1px solid rgb(217, 221, 227); padding:8px" required>
                                            
                                        </div>
                                        <div class="col-md-6 form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                            <label for="#contact_number">Contact number <i class="text-danger">*</i> :
                                                @if ($errors->has('contact_number'))
                                                    <span class="text-warning">{{ $errors->first('contact_number') }}</span>
                                                @endif
                                            </label>
                                            <input  style="border-radius:10px; " type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Ex: 09170000001" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title text-bold text-center">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                        Government IDs
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body" style="padding: 20px 30px">
                                    <div class="form-group">
                                        <label>TIN:</label>
                                        <input  style="border-radius:10px; " type="text" class="form-control" id="tin" name="tin" placeholder="Tax Identification Number">
                                    </div>
                                    <div class="form-group">
                                        <label>SSS:</label>
                                        <input  style="border-radius:10px; " type="text" class="form-control" id="sss" name="sss" placeholder="Social Security Number">
                                    </div>
                                    <div class="form-group">
                                        <label>HMDF (PAG-IBIG):</label>
                                        <input  style="border-radius:10px; " type="text" class="form-control" id="hmdf" name="hmdf" placeholder="HMDF (Pag-big) Number">
                                    </div>
                                    <div class="form-group">
                                        <label>PHILHEALTH:</label>
                                        <input  style="border-radius:10px; " type="text" class="form-control" id="philhealth" name="philhealth" placeholder="PhilHealth Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title text-bold text-center">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                        Other Information  <small class="text-muted">(optional)</small>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body" style="padding: 20px 30px">
                                    <div class="row-fluid">
                                        <h4 style="margin-top:0;">Contact Person <small>(in case of emergency)</small></h4>
                                        <div class="form-group">
                                            <label>Name:</label>
                                            <input  style="border-radius:10px; " type="text" class="form-control" id="emergency_contact_person" name="emergency_contact_person" placeholder="Full name">
                                        </div>
                                        <div class="form-group">
                                            <label>Relationship</label>
                                            <input  style="border-radius:10px; " type="text" class="form-control" id="emergency_contact_relationship" name="emergency_contact_relationship" placeholder="Ex. Father/Mother">
                                        </div>
                                        <div class="form-group">
                                            <label>Contact Number: (landline/cellphone)</label>
                                            <input  style="border-radius:10px; " type="number" class="form-control" id="emergency_contact_number" name="emergency_contact_number" placeholder="Ex: 09170000001">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group" style="width:100%; text-align:center;  ">
                        <button  style=" width:50%; padding-top:10px;" type="submit" class="btn btn-primary "> <i class="fa fa-save">&nbsp;</i>  Save</button>
                    </div>
                </form>                       
            </div>
        </div>
    </div>
</div>

@push('js')
<script type="text/javascript">
    
$(function(){
    $('#employee-form').validate();
});
</script>
@endpush