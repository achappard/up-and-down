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
            <a href="{{ URL::to('/') }}" class="logo">
                <span class="logo-mini"><b>U</b>A<b>D</b></span>
                <span class="logo-lg"><b>Up</b>And<b>Down</b></span>
            </a>
            @include('admin.shared.top_nav_bar')
        </header>
        @include('admin.shared.main_sidebar')
        <div class="content-wrapper">
            <section class="content-header">
                <h1>{!! $page_title !!}</h1>
                @if(! empty($breadcrumb))
                    <ol class="breadcrumb">
                        @foreach ($breadcrumb as $b)
                            <li @if($loop->last) class="active"@endif>
                                @if ($b['url'])
                                    <a href="{{ $b['url'] }}">
                                        @endif
                                        {!! $b['label'] !!}
                                        @if ($b['url'])
                                    </a>
                                @endif
                            </li>

                        @endforeach
                    </ol>
                @endif
            </section>
            <section class="content">

                @if (Session::has('flash_success_message'))
                <div id="alert-zone" class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {!! Session::get('flash_success_message') !!}
                        </div>
                    </div>
                </div>
                @endif

                @yield('content')
            </section>
        </div>
        @include('admin.shared.footer')
    </div>
    @include('admin.shared.scripts_footer')
</body>
</html>

