@extends('adminlte::page')
@section('content')
<div class="row" style="margin: 0;font-family: sans-serif;font-weight: 100;height:100%;width:100%">
    <div class="col-md-3">
        <div class="box" style="box-shadow: 0 0 15px  rgb(0,0,0,0.2); border-top-left-radius:10px;  border-top-right-radius:10px;" >
            <div class="box-body box-profile">
                <div class="profile_image">
                    <img src="{{asset('images/no-image.jpg')}}" class="profile-user-img img-responsive img-circle" alt="jigs" width="40%" > 
                </div>
                <div class="profile_information">
                    <h4 class="profile-username text-center "><a>{{$user->fullname}}</a></h4>
                    <h6 class="text-muted text-center"></h6>
                    <h6  class="text-muted text-center">Contact#: 09756102690/224-5123</h6>
                    <hr style="background-color:rgb(0,0,0);">
                    <div class="row" style="text-overflow:ellipsis; margin:0;">
                        <button style="width:100%; border-radius: 20px;padding:8px;" type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal">Change Password</button>
                    <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog" >
                            <div class="modal-dialog" style="width:30%;border-radius:10px;  ">
                            <!-- Modal content-->
                                <div class="modal-content" style="border-radius:10px;">
                                    <div class="modal-header" style="background-color:rgb(60, 141, 188); color:white; ">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Change Password</h4>
                                    </div>
                                    <div class="modal-body" >
                                        <form id="myform" action="process_registration.php" class="basic-grey" method="post">
                                            <div class="form-group">
                                                <label for="password" id="currentpassword_label">Current Password:</label>
                                                <input style="border-radius:10px;" class="form-control" type="password" name="password" id="currentpassword"  />
                                            </div>
                                            <div class="form-group">
                                                <label for="password" id="passwordLabel">* Password:</label>
                                                <input style="border-radius:10px;" class="form-control" type="password" name="password" id="password" minlength=1 required />
                                            </div>
                                            <div  class="form-group">
                                                <label for="passwordConfirm" id="passwordLabelConfirm">*Password Confirmation:</label>
                                                <input style="border-radius:10px;"  class="form-control" type="password" name="passwordConfirm" id="passwordConfirm" minlength=1 required />
                                                <span id="message"></span>
                                            </div>
                                            <div  class="form-group" style="text-align:center; margin-top:30px; " >
                                                <input style="border-radius:10px; width:50%; margin-left:25%;"   class="form-control" id="submit" type="submit" name="submit" value="Submit"/>
                                            </div>
                                        </form>
                                    <!-- <p>Some text in the modal.</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="nav-tabs-custom" style=" box-shadow: 0 0 15px  rgb(0,0,0,0.2); " >
            <ul class="nav nav-tabs">   
                <li class="active">
                    <a href="#attendance" data-toggle="tab" aria-expanded="true">Activity Log</a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="attendance">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
    <script src="{{ \asset('vendor/jquery-validation/js/jquery-validate.js') }}"></script>
    <script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ \asset('js/password-confirmation.js') }}" type="text/javascript"></script>
@endpush