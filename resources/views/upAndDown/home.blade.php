@extends('layouts.app')

@section('content')
<div id="defaultpanel">
    <div id="uploadPanel" class="panel panel-default">
        <div class="panel-body">
            <div id="file-list">
                <p class="text-center">
                    <a href="#" id="addFilesToUpload_first"><span class="plus-sign">+</span> Ajouter vos fichiers</a>
                </p>
                <div id="filesZone"></div>
                <p><a href="#" class="addMoreFilesToUpload"><span class="plus-sign">+</span> Ajouter plus de fichiers</a></p>
            </div>
            {{ Form::open(['route' => 'upload','files' => true, 'id' => 'uploadForm']) }}

            <div class="form-group">
                <label for="inputTo" class="sr-only">Envoyer à</label>
                <input placeholder="Envoyer à" type="text" name="to" id="inputTo" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="inputMessage" class="sr-only">Message</label>
                <textarea  class="form-control" name="message" id="inputMessage" cols="30" rows="2" placeholder="Message"></textarea>
            </div>
            {{-- The main input file--}}
            <div id="input-file-wrapper"></div>
            <button type="submit" class="btn btn-default btn-block">Transférer</button>
            {{ Form::close() }}
        </div>
    </div>
</div>

@endsection



@push('scripts')
<script>
    (function($){
        $(document).ready(function() {
           upanddown.upload_form();
        });
    })(jQuery);
</script>
@endpush