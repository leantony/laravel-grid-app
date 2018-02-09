<form action="{{ $filterUrl }}" method="GET" id="{{ $id }}">
    @foreach($rows as $row)
        @if(!$row->filter)
            <th></th>
        @else
            <th style="width: inherit;">
                {!! $row->filter !!}
            </th>
        @endif
        @if($loop->last)
            <th style="width: inherit;" class="pull-right">
                <button type="submit" class="btn btn-secondary" title="filter data">Filter
                </button>
            </th>
        @endif
    @endforeach
</form>