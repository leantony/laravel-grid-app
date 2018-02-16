<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha256-916EbMg70RQy9LHiGkXzG8hSg9EdNy97GazNG/aiY1w=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha256-NuCn4IvuZXdBaFKJOAcsU2Q3ZpwbdFisd5dux4jkQ5w=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css" integrity="sha256-WgFzD1SACMRatATw58Fxd2xjHxwTdOqB48W5h+ZGLHA=" crossorigin="anonymous" />
    </head>
    <body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <a class="navbar-brand" href="/">Laravel Grid (sample app)</a>
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="{{ url('/users') }}">Grid</a>
            </li>
            <li>
                <a href="{{ url('https://github.com/leantony/laravel-grid') }}">Github package</a>
            </li>
            <li>
                <a target="_blank" href="{{ url('https://github.com/leantony/laravel-grid') }}">Documentation (coming soon)</a>
            </li>
        </ul>
    </nav>
    <div class="container" style="margin-top: 80px; margin-bottom: 100px;">
        <div class="row">
            <div class="col-md-12">
                {!! $grid !!}
            </div>
        </div>
    </div>
    @include('leantony::modal.container')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js" integrity="sha256-8Te5uZFXTW5VNskYNkjCnaNnGRweXs4cOVvlTSBECYY=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js" integrity="sha256-9wRM03dUw6ABCs+AU69WbK33oktrlXamEXMvxUaF+KU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js" integrity="sha256-TueWqYu0G+lYIimeIcMI8x1m14QH/DQVt4s9m/uuhPw=" crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/leantony/grid/js/grid.js') }}"></script>
    <script>
        // setup ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // initialize modal js
        leantony.modal.init({});
        // table links
        leantony.utils.tableLinks({element: '.linkable', navigationDelay: 100});
        // setup ajax listeners
        leantony.utils.executeAjaxRequest($('.data-remote'), 'click');
        leantony.utils.executeAjaxRequest($('form[data-remote]'), 'submit');
    </script>
    @stack('scripts')
    </body>
</html>
