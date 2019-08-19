@extends('layout.blank')
@section('content')
    <div id="app" class="card white" style="width: 20rem;">
        <div class="container-fluid" style="height: inherit;">
            <img class="img-fluid" src="{{\asset('images/logo.jpg')}}" style="padding-top: 15px;" alt="FriendzPH Logo">
        </div>
        <div class="card-body container-fluid white">
            <form method="POST" action="{{ \route('office.login.attempt') }}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger text-xs">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h4>Reset Password</h4>
                <div class="form-group">
                    <label for="password" id="passwordLabel">* Password:</label>
                    <input style="border-radius:10px;" class="form-control" type="password" name="password" id="password" minlength=1 required />
                </div>
                <div  class="form-group">
                    <label for="passwordConfirm" id="passwordLabelConfirm">*
                    Password Confirmation:</label>
                    <input style="border-radius:10px;"  class="form-control" type="password" name="passwordConfirm" id="passwordConfirm" minlength=1 required />
                    <span id="message"></span>
                </div>
                <div class="text-center">
                    <button dusk="login-button" class="btn btn-block btn-primary waves-effect waves-light">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>
@endpush