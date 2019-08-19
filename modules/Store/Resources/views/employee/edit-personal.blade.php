<div class="modal fade" id="profile-personal">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 5px">
            <div class="modal-body" style="padding: 30px;">
                <form id="profile-personal-form" method="POST" action="{{ route('store.employee.profile.edit', compact('employee')) }}" >
                    @csrf
                    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                        <label for="#first_name">First Name <i class="text-danger">*</i> :
                            @if ($errors->has('first_name'))
                                <span class="text-warning">{{ $errors->first('first_name') }}</span>
                            @endif
                        </label>
                        <input  style="border-radius:10px;"  type="text" class="form-control" id="first_name" name="first_name" value="{{ $employee->first_name }}" placeholder="Given Name" required minlength="1">
                    </div>
                    <div class="form-group {{ $errors->has('middle_name') ? 'has-error' : '' }}">
                        <label for="#middle_name">Middle Name: <small class="text-muted">(Optional)</small></label>
                        <input  style="border-radius:10px;" type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="{{ $employee->middle_name }}"  minlength="1">
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
                        <input  style="border-radius:10px;" type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ $employee->last_name }}" required minlength="1">
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
                            <input  placeholder="Date" class="form-control" type="text" id="birthdate" value="{{ $employee->birthdate }}" data-provide="datepicker" name="birthdate"  style=" border-radius:10px; border:1px solid rgb(217, 221, 227); padding:8px" required>
                            
                        </div>
                        <div class="col-md-6 form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                            <label for="#contact_number">Contact number <i class="text-danger">*</i> :
                                @if ($errors->has('contact_number'))
                                    <span class="text-warning">{{ $errors->first('contact_number') }}</span>
                                @endif
                            </label>
                            <input  style="border-radius:10px; " type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $employee->contact_number }}" placeholder="Ex: 09170000001" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Send</button>
                </form>
            </div>
            <div class="modal-footer" style="border: 0; padding: 0;">
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

@push('js')
<script type="text/javascript">
    personal_modal = $('profile-personal');
    $(function(){
        personal_modal.find('#profile-personal-form').validate();
    });
</script>
@endpush