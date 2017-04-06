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
                    <a href="#" class="link-step" data-step="1">
                        <div class="number">1</div>
                        <div class="step-name">Sélection</div>
                    </a>
                </li>
                <li>
                    <a href="#" class="link-step" data-step="2">
                        <div class="number">2</div>
                        <div class="step-name">Coordonnées</div>
                    </a>
                </li>
                <li>
                    <a href="#" class="link-step" data-step="3">
                        <div class="number">3</div>
                        <div class="step-name">Envoie</div>
                    </a>
                </li>
            </ul>
            <div id="steps">
                <div id="step1" class="step">
                    <h4>Sélectionnez un fichier à envoyer :</h4>
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            @foreach( $files_availables as $file)
                            <tr role="row">
                                <td>
                                    <span class="meta-name">
                                        {{ pathinfo($file)['basename'] }} <small class="text-muted">({{ SizeHelper::formatSizeUnits(Storage::size($file)) }})</small>
                                    </span>
                                    <span class="actions">
                                        <a class="choose-file" href="#step2" data-filename="{{ pathinfo($file)['basename'] }}" data-file="{{ $file }}"><small>Choisir ce fichier</small></a>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="step2" class="step hidden">
                    <h4>Renseignez le correspondant :</h4>
                    <div class="row">
                        <div class="col-sm-3">
                            <p id="visuel-file" class="text-center lead">
                                <i class="fa fa-file-archive-o" aria-hidden="true"></i>
                                <br>
                                <small id="filename">labl.jpg</small>
                            </p>
                        </div>
                        <div class="col-sm-9">
                            <form class="form-horizontal">


                                <input id="file-to-send" name="file-to-send" type="hidden" class="form-control">
                                <div class="form-group">
                                    <label for="email_to" class="col-sm-2 control-label">Destinataire :</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <input type="email" class="form-control" name="email_to" id="email_to" placeholder="Email">
                                        </div>
                                        <span class="help-block">
                                    <small>Saisissez l'adresse email de votre correspondant</small>
                                </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name_from" class="col-sm-2 control-label">Message :</label>
                                    <div class="col-sm-10">
                                        <textarea rows="6" cols="10" class="form-control" style="resize: vertical"></textarea>
                                        <span class="help-block">
                                    <small>Écrivez un message à votre correspondant lui indiquant par exemple les documents qu'il trouvera en téléchargeant le fichier mis à sa disposition</small>
                                </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="expiration_date" class="col-sm-2 control-label">Expiration du lien :</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker">
                                        </div>
                                        <span class="help-block">
                                    <small>Saisissez une date si vous souhaitez que votre correspondant puisse télécharger le fichier avant</small>
                                </span>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-push-2">
                                        <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-share-alt"></span> Envoyer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
<script>
    $(function() {
        adminUp.sending();
    });
</script>
@endpush