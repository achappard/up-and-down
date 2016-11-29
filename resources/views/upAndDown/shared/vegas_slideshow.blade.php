{{-- On ne charge le js que si des background sont dispo--}}
@if( $backgrounds )
    <script src="{{ URL::asset('upAndDown/js/vendor/vegas/vegas.min.js') }}"></script>
    <script>
        (function($){
            $(document).ready(function() {
                upanddown.vegas_slideshow.backgroundList = [
                    @foreach ($backgrounds as $b)
                    { src:"{{ $b->url }}" }
                    @if (!$loop->last)
                    ,
                    @endif
                    @endforeach
                ];
                upanddown.vegas_slideshow.init();
            });
        })(jQuery);
    </script>
@endif