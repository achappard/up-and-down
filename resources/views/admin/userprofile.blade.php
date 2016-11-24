@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ Auth::user()->avatar(128) }}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>


                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Email</b> <a class="pull-right" href="#">aurelien.chappard@deefuse.fr</a>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="false">Paramètres</a></li>
                </ul>
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <!-- /.tab-pane -->

                    <div class="tab-pane active" id="settings">
                        {{ Form::model(Auth::user(), array('route' => ['userprofile.update',  Auth::user()], 'class' => 'form-horizontal', 'method' => 'put')) }}
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label for="inputName" class="col-sm-2 control-label">Nom</label>
                                <div class="col-sm-10">
                                    {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'inputName', 'placeholder' => 'Votre nom', 'required' => 'required')) }}
                                    @if($errors->has('name'))
                                        <span class="help-block">{{ $errors->first("name") }}</span>
                                    @endif
                                </div>
                            </div>
                        <div class="form-group @if($errors->has('email')) has-error @endif">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    {{ Form::email('email', null, array('class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'Votre email', 'required' => 'required')) }}
                                    @if($errors->has('email'))
                                        <span class="help-block">{{ $errors->first("email") }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('password')) has-error @endif">
                                <label for="inputPassword" class="col-sm-2 control-label">Mot de passe</label>

                                <div class="col-sm-10">
                                    <input class="form-control" name="password" id="inputPassword"  type="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('password_confirmation')) has-error @endif">
                                <label for="inputPasswordConfirm" class="col-sm-2 control-label">Confirmation</label>

                                <div class="col-sm-10">
                                    <input class="form-control" name="password_confirmation" id="inputPasswordConfirm"  type="password">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-saved"></span> Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </div>
        </div>
    </div>

@endsection