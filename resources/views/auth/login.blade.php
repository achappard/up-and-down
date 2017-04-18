@extends('layouts.app')

@section('pagetitle', '| Login')
@section('content')

<div id="defaultpanel">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><p class="h3">Connexion</p></div>
        <div class="panel-body">
            <form role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="sr-only">E-Mail</label>

                        <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="sr-only">Password</label>

                        <input id="password" placeholder="Mot de passe" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Se souvenir de moi
                        </label>
                    </div>
                </div>

                <div class="form-group text-center">
                        <button type="submit" class="btn btn-default btn-block">
                            <strong>Se connecter</strong>
                        </button>

                        <a class="btn btn-link" href="{{ url('/password/reset') }}">
                            Mot de passe oublié ?
                        </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection