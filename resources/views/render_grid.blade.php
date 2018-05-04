@extends('layouts.layout')

@section('content')
    <div class="col-md-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="grid-tab" data-toggle="tab" href="#grid" role="tab" aria-controls="home" aria-selected="true">Grid</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="code-tab" data-toggle="tab" href="#code" role="tab" aria-controls="profile" aria-selected="false">Code</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent" style="margin-top: 15px;">
            <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                <h2>Grid generated</h2>
                <p>The grid below was generated using the command <code>{{ $generation_command }}</code>.</p>
                <p>
                    How to use & generate this grid can be found <a href="{{ url('https://github.com/leantony/laravel-grid/wiki/Usage') }}">here</a>.
                </p>
                <hr>
                {!! $grid !!}
            </div>
            <div class="tab-pane fade" id="code" role="tabpanel" aria-labelledby="code-tab">
                <h2>Grid code</h2>
                <script src="{{ asset($grid_code) }}"></script>
            </div>
        </div>
    </div>
@endsection
