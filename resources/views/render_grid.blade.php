@extends('layouts.layout')

@section('content')
    <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#grid" role="tab" data-toggle="tab">Grid</a></li>
            <li><a href="#gridCode" role="tab" data-toggle="tab">Grid Code</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="grid">
                <h2>Grid generated</h2>
                <p>The grid below was generated using the command <code>{{ $generation_command }}</code>.</p>
                <p>
                    How to use & generate this grid can be found <a href="{{ url('https://github.com/leantony/laravel-grid/wiki/Usage') }}">here</a>.
                </p>
                <hr>
                {!! $grid !!}
            </div>
            <div class="tab-pane fade" id="gridCode">
                <h2>Grid code</h2>
                <script src="{{ asset($grid_code) }}"></script>
            </div>
        </div>
    </div>
@endsection
