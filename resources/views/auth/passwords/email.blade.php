@extends('layouts.app')

@section('pagetitle', '| Mot de passe oublié')
<!-- Main Content -->
@section('content')

<div id="defaultpanel">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><p class="h3">Mot de passe oublié</p></div>
        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form role="form" method="POST" action="{{ url('/password/email') }}">
                {{ csrf_field() }}
                <p>
                    Saisissez votre email pour recevoir un lien permettant de re-générer votre mot de passe :
                </p>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="sr-only">E-Mail Address</label>

                    <input id="email" placeholder="Votre email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group text-center">
                        <button type="submit" class="btn btn-default btn-block">
                            Envoyer le lien
                        </button>
                    <a href="{{ url('/login') }}" class="btn btn-link">Se connecter</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
