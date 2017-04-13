@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="ion ion-document"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Fichiers disponibles en téléchargement</span>
                    <span class="info-box-number">{{ $nbDownloads }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-images"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Images de fond</span>
                    <span class="info-box-number">{{ $nbBackgrounds }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-borderp">
            <h3 class="box-title"><span class="glyphicon glyphicon-share-alt"></span> Envoyer un fichier</h3>
        </div>
        <div class="box-body">
            <ul id="step-download">
                <li class="hightlight">
                    <a href="#step1" class="link-step" data-step="1">
                        <div class="number">1</div>
                        <div class="step-name">Sélection</div>
                    </a>
                </li>
                <li>
                    <a href="#step2" class="link-step" data-step="2">
                        <div class="number">2</div>
                        <div class="step-name">Coordonnées</div>
                    </a>
                </li>
                <li>
                    <a href="#step3" class="link-step" data-step="3">
                        <div class="number">3</div>
                        <div class="step-name">Envoie</div>
                    </a>
                </li>
            </ul>
            <div id="steps">
                <div id="step0" class="step">
                    <p class="text-center lead">
                        Envoyez un nouveau document à votre correspondant en 3 clics
                        <br>

                    </p>
                    <p class="text-center">
                        <a href="#step1" class="btn btn-lg btn-primary">Commencer</a>
                    </p>
                </div>
                <div id="step1" class="step hidden">
                    @if($nbDownloads === 0)
                        <h4 class="no-file text-center">Aucun fichier n'est actuellement disponible pour l'envoi.</h4>
                    @elseif ( $nbDownloads === 1)
                        <h4>Sélectionnez le fichier à envoyer...<small> Bon et bien là apparement, y'a pas trop le choix</small></h4>
                    @else
                        <h4>Sélectionnez un fichier à envoyer parmi les <strong>{{ $nbDownloads }}</strong> disponibles :</h4>
                    @endif

                    <div id="thetable">
                        <table class="table table-bordered table-striped table-hover">
                            <tbody>
                                @foreach( $files_availables as $file)
                                <tr role="row">
                                    <td>
                                        <span class="meta-name">
                                            {{ pathinfo($file)['basename'] }} <small class="text-muted">({{ SizeHelper::formatSizeUnits(Storage::size($file)) }})</small>
                                        </span>
                                        <span class="actions">
                                            <a class="choose-file" href="#step2" data-filename="{{ pathinfo($file)['basename'] }}" data-file="{{ $file }}" data-filesize="{{ SizeHelper::formatSizeUnits(Storage::size($file)) }}"><small>Choisir ce fichier</small></a>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="step2" class="step hidden">
                    <h4>Renseignez le correspondant :</h4>
                    <div class="row">
                        <div class="col-sm-3">
                            <p id="visuel-file" class="text-center lead">
                                <i class="fa fa-file-archive-o" aria-hidden="true"></i>
                                <br>
                                <small id="filename"></small>
                                <small id="filesize">(3 Mo)</small>

                            </p>
                            <p class="text-center">
                                <a href="#step1" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-th-list"></span> Retour à la liste</a>
                            </p>
                        </div>
                        <div class="col-sm-9">
                            {{ Form::open(array('route' => 'download.store', 'class' => 'form-horizontal')) }}

                                <input id="file-to-send-input" name="file-to-send-input" type="hidden" value="{{ old('file-to-send-input') }}" />
                                <input id="file-name-input" name="file-name-input" type="hidden" value="{{ old('file-name-input') }}" />

                                <div class="form-group @if($errors->has('email_to')) has-error @endif">
                                    <label for="email_to" class="col-sm-2 control-label">Destinataire<sup class="text-danger">*</sup> : </label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <input type="email" class="form-control" name="email_to" id="email_to" value="{{ old('email_to') }}" placeholder="Email">
                                        </div>
                                        <span class="help-block">
                                            <small>
                                            @if($errors->has('email_to'))
                                                {{ $errors->first("email_to") }}
                                            @else
                                                Saisissez l'adresse email de votre correspondant
                                            @endif
                                            </small>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group @if($errors->has('message')) has-error @endif">
                                    <label for="message" class="col-sm-2 control-label">Message<sup class="text-danger">*</sup> :</label>
                                    <div class="col-sm-10">
                                        <textarea name="message" id="message" rows="6" cols="10" class="form-control" style="resize: vertical">{{ old('message') }}</textarea>

                                        <span class="help-block">
                                            <small>
                                            @if($errors->has('message'))
                                                    {{ $errors->first("message") }}
                                            @else
                                                Écrivez un message à votre correspondant lui indiquant par exemple les documents qu'il trouvera en téléchargeant le fichier mis à sa disposition
                                            @endif
                                            </small>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group @if($errors->has('expiration_date')) has-error @endif">
                                    <label for="expiration_date" class="col-sm-2 control-label">Expiration du lien :</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="expiration_date" class="form-control pull-right" id="datepicker" value="{{ old('expiration_date') }}">
                                        </div>
                                        <span class="help-block">
                                            <small>
                                                @if($errors->has('expiration_date'))
                                                    {{ $errors->first("expiration_date") }}
                                                @else
                                                    Saisissez une date si vous souhaitez que votre correspondant puisse télécharger le fichier avant
                                                @endif

                                            </small>
                                        </span>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-push-2">
                                        <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-share-alt"></span> Envoyer</button>
                                    </div>
                                </div>
                            {{ Form::close() }}

                        </div>
                    </div>


                </div>
                <div id="step3" class="step hidden">
                    <p class="text-center lead">
                        <strong>Bravo</strong>, votre document vient d'être envoyé !
                        <br>
                    </p>
                    <p class="text-center">
                        <a href="{{ URL::route('dashboard.index') }}#step1" class="btn btn-lg btn-primary">Envoyer un autre document</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
<script>
    $(function() {
        var init_obj = {
            has_error :  @if( count($errors->all()) > 0 ) 1 @else 0  @endif   ,
            store_download_success : @if (session('store_download') && session('store_download') == "success" ) 1 @else 0 @endif
        };
        adminUp.sending(init_obj);
    });
</script>
@endpush