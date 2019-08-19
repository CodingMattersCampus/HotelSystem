@extends('layout.blank')
@section('content')
    <div id="app" class="card white">
        <div class="card-body container-fluid white">
            <h3 class="text-blue">Welcome, {{ $user->firstName() }}!</h3>
            <p class="text-muted">You can now start your shift by accepting the initial Cash-on-hand of <span class="text-bold">&#8369;{{ \number_format($cash) }} Pesos</span>.</p>
            <br>
            <form method="POST" action="{{ \route('booking.drawer.transaction.start', compact('user')) }}">
                @csrf
                <input type="hidden" name="amount" value="{{$cash}}">
                <div class="text-center">
                    <button dusk="start-button" type="submit" class="btn btn-block btn-success waves-effect waves-light">Yes, I accept and I'm ready to work.</button>
                </div>
            </form>
            <br>
            <form METHOD="POST" action="{{\route('booking.logout.discontinue')}}">
                <div class="text-center">
                    @csrf
                    <button dusk="logout-button" type="submit" class="btn btn-block btn-danger waves-effect waves-light">No! Logged me out.</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ \asset('js/app.js') }}" type="text/javascript"></script>
@endpush