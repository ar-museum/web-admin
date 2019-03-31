@extends('layouts.auth')
@section('content')
    <form class="form-signin" method="POST" action="{{ route('login') }}" role="form">
        {!! csrf_field() !!}
        <h2 class="form-signin-heading">Autentificare</h2>
        <!-- Display Validation Errors -->
        @include('common.errors')
        <div class="login-wrap">
            <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email"
                   autofocus>
            <input type="password" name="password" class="form-control" placeholder="Parola">
            <label class="display-inline checkbox"><input type="checkbox" name="remember"> Tine-ma minte</label>
            <span class="reset-link pull-right">
                    <a data-toggle="modal" href="#reset-modal">Ai uitat parola?</a>
            </span>
            <button class="btn btn-lg btn-login btn-block" type="submit">Intra</button>
        </div>
    </form>

    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="reset-modal-label" role="dialog" tabindex="-1" id="reset-modal"
         class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="reset-modal-label">Ai uitat parola?</h4>
                </div>
                <div class="modal-body">
                    <p>Introdu adresa de email mai jos pentru a-ti reseta parola.</p>
                    <form class="form-vertical" role="form">
                        <div class="form-group">
                            <input type="text" id="email_reset" name="email_reset" placeholder="Email"
                                   autocomplete="off"
                                   class="form-control placeholder-no-fix">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Anuleaza</button>
                    <button class="btn btn-success" type="button" data-action="reset_pass">Reseteaza</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{!! asset('/js/auth/login.js') !!}"></script>
@endsection