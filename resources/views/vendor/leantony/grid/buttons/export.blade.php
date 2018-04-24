<a class="dropdown" data-toggle="tooltip" title="{{ $title }}" href="{{ is_callable($url) ? $url() : $url }}">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        <i class="fa {{ $icon }}"></i>&nbsp;{{ $name }}
    </button>
    <div class="dropdown-menu">
        @foreach($exportOptions as $k => $v)
            <a href="{{ $v['url'] }}" class="dropdown-item" title="{{ $v['title'] }}">
                <i class="fa fa-{{ $v['icon'] }}"></i>&nbsp;{{ $k }}
            </a>
        @endforeach
    </div>
</a>