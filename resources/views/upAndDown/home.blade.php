@extends('layouts.app')

@section('content')
<div id="defaultpanel">
    <div id="uploadPanel" class="panel panel-default">
        <div class="panel-body">
            <div id="transfert">
                <div id="divProgress"></div>
                <p class="text-center">
                    <span class="title">Transfert en cours...</span>
                </p>
                <p id="pcentValue"></p>
                <p class="text-center">
                    <a href="#" id="cancelUpload" class="btn btn-primary btn-block">Annuler ce transfert</a>
                </p>
            </div>
            <div id="error_transfert">
                <img src="{{ URL::asset('upAndDown/img/smiley_error.svg') }}" alt=""/>
                <p class="text-center">
                    <span class="title">Erreur lors du transfert...</span>
                </p>
                <p class="text-center">
                    Une erreur est survenue lors de ce transfert. Voici la raison donnée : <code id="error-reason"></code>
                </p>
                <p class="text-center">
                    <a href="{{ URL::to('/') }}" class="btn btn-primary btn-block">Nouveau transfert</a>
                </p>
            </div>
            <div id="finish_transfert">
                <img src="{{ URL::asset('upAndDown/img/smiley_happy.svg') }}" alt=""/>
                <p class="text-center">
                    <span class="title">Transfert terminé !</span>
                </p>
                <p class="text-center">
                    <a href="{{ URL::to('/') }}" class="btn btn-primary btn-block">Nouveau transfert</a>
                </p>
            </div>
            <div id="file-list">
                <p class="text-center">
                    <a href="#" id="addFilesToUpload_first"><span class="plus-sign">+</span> Ajouter vos fichiers</a>
                </p>
                <div id="filesZone"></div>
                <p><a href="#" class="addMoreFilesToUpload"><span class="plus-sign">+</span> Ajouter plus de fichiers</a></p>
                <div id="errorFileList" class="">
                    <div id="arrow-error"></div>
                    <p class="text-center h1"><span class="glyphicon glyphicon-cloud-upload"></span></p>
                    <p class="text-center">Veuillez sélectionner au moins un fichier à transmettre.</p>
                </div>
            </div>
            {{ Form::open(['route' => 'upload','files' => true, 'id' => 'uploadForm']) }}

            <div id="block-inputTo" class="form-group">
                <label for="inputTo" class="sr-only">Envoyer à</label>
                <input placeholder="Envoyer à"
                       type="text"
                       name="to"
                       id="inputTo"
                       class="form-control"/>
                <span class="help-block" id="helpBlock-inputTo"></span>
            </div>
            <div id="block-inputMessage" class="form-group">
                <label for="inputMessage" class="sr-only">Message</label>
                <textarea placeholder="Message"
                          class="form-control"
                          name="message"
                          id="inputMessage"
                          cols="30"
                          rows="2"></textarea>
                <span class="help-block" id="helpBlock-inputMessage"></span>
            </div>
            {{-- The main input file--}}
            <div id="input-file-wrapper"
                 data-url="{{ route('upload') }}"
                 data-sequential-uploads="true">
            </div>
            <button type="submit"
                    id="submit-upload"
                    class="btn btn-default btn-block">Transférer</button>
            {{ Form::close() }}
        </div>
    </div>
</div>

@endsection


@push('additional_js_files')
{{--<script src="{{ URL::asset('upAndDown/js/jquery.classyloader.min.js') }}"></script>--}}
<script src="{{ URL::asset('upAndDown/js/vendor/jquery-circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ URL::asset('upAndDown/js/vendor/jquery-fileupload/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('upAndDown/js/vendor/jquery-fileupload/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('upAndDown/js/vendor/jquery-fileupload/jquery.fileupload.js') }}"></script>
@endpush

@push('scripts')
<script>
    (function($){
        $(document).ready(function() {
           upanddown.upload_form();
        });
    })(jQuery);
</script>
@endpush

