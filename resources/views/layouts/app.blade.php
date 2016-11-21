<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'UpAndDown') }} {{ config('app.version') }} | Home</title>
    @include('upAndDown.shared.styles_scripts_header')
    @include('upAndDown.shared.favicons')

</head>
<body>

    @yield('content')
    <ul>
        <!-- Authentication Links -->
        @unless  (Auth::guest())
            <li>
                <a href="{{ url('/admin') }}">Admin</a>
            </li>
            <li class="dropdown">
                <a href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        @endunless
    </ul>
    @include('upAndDown.shared.scripts_footer')
    @stack('scripts')
</body>
</html>
