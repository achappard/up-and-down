@extends('layouts.app')
@section('pagetitle', '| Téléchargement en cours...')
@section('content')

    <div id="downloadpanel">
        <div class="panel panel-default">
            <div class="panel-heading text-center"><p class="h3">Téléchargement prêt !</p></div>
            <div class="panel-body">

                <p>Le <em>{{$date_created}}</em>, <strong>{{$download->from_name}}</strong> vous a envoyé un fichier :</p>
                <ul>
                    <li>{{$file_name}} <small>({{$file_size}})</small></li>
                </ul>
                <div class="message_user">
                    <p class="alert alert-info">
                        {!! $message !!}
                    </p>
                </div>

                {{-- Note sur la date de péremption s'il y en a une --}}
                @if( $expired_link )
                    <p class="note-expiration alert alert-warning"><small>Malheureusement le lien de téléchargement à expiré le <em>{{$date_expiration_str}}</em></small></p>
                @endif
                {{-- Fin de note--}}


                @if( $expired_link == false )
                    <a class="btn btn-primary btn-block" href="{{ URL::route('retrieve_document', $download->uuid) }}">Télécharger</a>
                @endif

                {{--<button class="btn btn-primary">Télécharger</button>--}}
            </div>
        </div>
    </div>

@endsection