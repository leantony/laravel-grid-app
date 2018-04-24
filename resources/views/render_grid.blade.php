@extends('layouts.layout')

@section('content')
    <div class="col-md-12">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#grid">Grid</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#gridCode">Grid code</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="row" style="margin-top: 20px;">
                <div class="tab-pane active container" id="grid">
                    <h2>Grid generated</h2>
                    <p>The grid below was generated using the command <code>{{ $generation_command }}</code>.</p>
                    <p>
                        How to use & generate this grid can be found <a href="{{ url('https://github.com/leantony/laravel-grid/wiki/Usage') }}">here</a>.
                    </p>
                    <hr>
                    {!! $grid !!}
                </div>
                <div class="tab-pane container" id="gridCode">
                    <h2>Grid code</h2>
                    <script src="{{ asset($grid_code) }}"></script>
                </div>
            </div>

        </div>
    </div>
@endsection
