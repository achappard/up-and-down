@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="ion ion-ios-box"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">téléchargements disponibles</span>
                    <span class="info-box-number">{{ $nbDownloads }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-images"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">images de fond</span>
                    <span class="info-box-number">{{ $nbBackgrounds }}</span>
                </div>
            </div>
        </div>
    </div>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Title</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        Start creating your amazing application!
    </div>
    <div class="box-footer">
        Footer
    </div>
</div>
@endsection