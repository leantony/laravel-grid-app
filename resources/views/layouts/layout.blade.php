<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/flatly/bootstrap.min.css" integrity="sha256-r1WijW/SNMgOwk5LDk7QRHr6oVYYbYWMw/1kOXfYJfg=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha256-NuCn4IvuZXdBaFKJOAcsU2Q3ZpwbdFisd5dux4jkQ5w=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.27/daterangepicker.min.css" integrity="sha256-m4uCSkjNdbrhPh2GPVsyB8nuDl5uiF/DpAhSGdqujrc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.css" integrity="sha256-no0c5ccDODBwp+9hSmV5VvPpKwHCpbVzXHexIkupM6U=" crossorigin="anonymous" />
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <a class="navbar-brand" href="/">Laravel Grid (sample app)</a>
    <ul class="nav navbar-nav">
        <li>
            <a href="{{ url('https://github.com/leantony/laravel-grid') }}">Github package</a>
        </li>
        <li>
            <a href="{{ url('https://packagist.org/packages/leantony/laravel-grid') }}">Packagist</a>
        </li>
        <li>
            <a href="{{ url('https://github.com/leantony/laravel-grid/wiki') }}">Docs</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Examples <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{ url('/users') }}">Users</a></li>
                <li><a href="{{ url('/roles') }}">Roles</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div class="row">
    <div class="jumbotron">
        <div class="container" style="margin-top: 50px;">
            <h1>Laravel Grid View</h1>
            <p>Simple, customizable, pjax ready bootstrap styled grid view for the laravel framework, inspired by the yii2 gridview widget. For laravel 5.5 and above.
            <p>
                <a class="btn btn-primary btn-lg" href="{{ url('https://github.com/leantony/laravel-grid') }}">View on Github
                    <i class="fa fa-github"></i></a>
            </p>
        </div>
    </div>
</div>
<div class="container" style="margin-bottom: 100px;">
    <div class="row">
        @yield('content')
    </div>
</div>
@include('leantony::modal.container')
<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js" integrity="sha256-XWzSUJ+FIQ38dqC06/48sNRwU1Qh3/afjmJ080SneA8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.27/moment.min.js" integrity="sha256-TkEcmf5KSG2zToAaUzkq6G+GWezMQ4lEtaBiyaq6Jb4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js" integrity="sha256-8Te5uZFXTW5VNskYNkjCnaNnGRweXs4cOVvlTSBECYY=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js" integrity="sha256-9wRM03dUw6ABCs+AU69WbK33oktrlXamEXMvxUaF+KU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.27/daterangepicker.min.js" integrity="sha256-fuPJ7xvV6OPcIGSJd2Xj7s/+2aWsVGapv+Uj/cuVOzk=" crossorigin="anonymous"></script>
<script src="{{ asset('vendor/leantony/grid/js/grid.js') }}"></script>
<script>
    // setup ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('pjax:start', function() { NProgress.start(); });
    $(document).on('pjax:end',   function() { NProgress.done();  });
</script>
@stack('grid_js')
</body>
</html>
