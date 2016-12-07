<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'UpAndDown') }} {{ config('app.version') }} | Home</title>
    @include('upAndDown.shared.styles_scripts_header')
    @include('upAndDown.shared.favicons')

</head>
<body>

    @yield('content')

    @include('upAndDown.shared.main_menu')

    @include('upAndDown.shared.scripts_footer')
    @include('upAndDown.shared.vegas_slideshow')
    @stack('scripts')
</body>
</html>
