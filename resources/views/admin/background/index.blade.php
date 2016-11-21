@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Gestion des images de fond
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Gestion des image de fond</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    @foreach ($background_images as $img)
                        <div class="col-md-2">
                            <div class="box box-default">

                                <div class="box-body">
                                    <img src="{{ $img->url }}" class="img-responsive" alt=""/>
                                </div>
                                <div class="box-footer text-center">
                                    <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal" data-idbackground="{{ $img->id  }}">Suppression</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ajout de nouvelles images de fond :</h3>
                    </div>
                    <form method="post" action="{{ url('/admin/background-management/add') }}">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="url" class="control-label">URL de l'image</label>
                                <input class="form-control" id="url" placeholder="http://" type="text" name="url">
                            </div>
                            <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-saved"></span> Enregistrer cette nouvelle image</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Souhaitez-vous réellement supprimer cette image ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            Si vous cliquez sur <kbd>oui</kbd>, cette image sera définitivement supprimée du diaporama
                        </p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger">OUI</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection