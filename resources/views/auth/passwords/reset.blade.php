@extends('layouts.app')

@section('content')
<div id="defaultpanel">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><p class="h3">Reset Password</p></div>
        <div class="panel-body">
            <form role="form" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="sr-only">Votre email</label>
                    <input id="email" type="email" placeholder="Votre email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="sr-only">"Mot de passe</label>
                    <input id="password" type="password" placeholder="Mot de passe" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="sr-only">Confirmation</label>
                    <input id="password-confirm" type="password" placeholder="Confirmation" class="form-control" name="password_confirmation" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-default btn-block">
                        Reset Password
                    </button>
                    <a href="{{ url('/login') }}" class="btn btn-link">Se connecter</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
