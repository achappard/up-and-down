@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="row">
            @foreach ($background_images as $img)
                <div class="col-md-3">
                    <div class="box box-default">

                        <div class="box-body">
                            <img src="{{ $img->url }}" class="img-responsive" alt=""/>
                        </div>
                        <div class="box-footer text-center">
                            <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#deleteBackgroundModal" data-idbackground="{{ $img->id  }}">Suppression</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ajout de nouvelles images de fond :</h3>
            </div>
            {{ Form::open(array('route' => 'background.store')) }}
                <div class="box-body">
                    <div class="form-group @if($errors->has('url')) has-error @endif">
                        <label for="url" class="control-label">URL de l'image</label>
                        <input class="form-control" id="url" placeholder="http://" type="text" name="url" value="{{ old('url') }}">
                        @if($errors->has('url'))
                        <span class="help-block">{{ $errors->first("url") }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-saved"></span> Enregistrer cette nouvelle image</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<div class="modal fade" id="deleteBackgroundModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Souhaitez-vous réellement supprimer cette image ?</h4>
            </div>
            {{ Form::open(['route' => ['background.destroy', 0], 'method' => 'delete', 'id' => 'deleteBackgroundForm']) }}
                <div class="modal-body">
                    <p>
                        Si vous cliquez sur <kbd>oui</kbd>, cette image sera définitivement supprimée du diaporama
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitdelete_btn" class="btn btn-danger">OUI</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                </div>
            {{ Form::close() }}
        </div>
        <!-- /.modal-content -->
    </div>
</div>
@endsection