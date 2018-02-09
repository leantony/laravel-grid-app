<input type="text" name="{{ $name }}" id="{{ $id }}"
       class="{{ $class }}" value="{{ request($name) }}" title="{{ $title }}" placeholder="{{ $title }}"
       style="font-size: 12px;"
       @foreach($dataAttributes as $k => $v)
       data-{{ $k }}={{ $v }}
        @endforeach
>