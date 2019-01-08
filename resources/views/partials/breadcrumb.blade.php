<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($segments = Request::segments() as $index => $segment)
            @if($index != count($segments) - 1)
                <li class="breadcrumb-item">
                    <a href="{{ URL::to(implode('/', array_slice($segments, 0, $index + 1))) }}">
                        {{ ucfirst(is_numeric($segment) ? str_singular($segments[$index - 1]) . '#' . $segment : $segment) }}
                    </a>
                </li>
            @else
                <li class="breadcrumb-item active">
                    {{ ucfirst(is_numeric($segment) ? str_singular($segments[$index - 1]) . '#' . $segment : $segment) }}
                    {{-- {{ ucfirst(is_numeric($segment) ? str_singular($segments[$index - 1]) . '#' . $segment : $segment) }} --}}
                </li>
            @endif
        @endforeach
    </ol>
</nav>