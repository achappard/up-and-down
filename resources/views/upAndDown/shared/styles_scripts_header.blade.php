<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" />
<link href="{{ URL::asset('upAndDown/css/upanddown.css') }}" rel="stylesheet">
<link href="{{ URL::asset('upAndDown/css/vegas.min.css') }}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
    ]); ?>
</script>