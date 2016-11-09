<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UpAndDown 1.0 | Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('admin.shared.styles_scripts_header')
</head>
<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">
        <header class="main-header">
            <a href="index2.html" class="logo">
                <span class="logo-mini"><b>U</b>A<b>D</b></span>
                <span class="logo-lg"><b>Up</b>And<b>Down</b></span>
            </a>
            @include('admin.shared.top_nav_bar')
        </header>
        @include('admin.shared.main_sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('admin.shared.footer')
    </div>
    @include('admin.shared.scripts_footer')
</body>
</html>

